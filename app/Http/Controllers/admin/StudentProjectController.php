<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentProjectController extends Controller
{
    public function index()
    {
        $projects = StudentProject::latest()
                    ->filter(request(['search', 'sort']))
                    ->get();
                    
        return view('admin.landing_page.student_projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.landing_page.student_projects.create');
    }

    public function store(Request $request)
    {
        // Sesuaikan validasi dengan nama kolom Anda
        $validatedData = $request->validate([
            'student_name'  => 'required|string|max:255',
            'project_type'  => 'required|string|max:255',
            'project_image' => 'required|image|max:2048', 
        ]);

        if ($request->hasFile('project_image')) {
            $validatedData['project_image'] = $request->file('project_image')->store('student_projects', 'public');
        }

        StudentProject::create($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(StudentProject $project)
    {
        return view('admin.landing_page.student_projects.edit', compact('project'));
    }

    public function update(Request $request, StudentProject $project)
    {
        $validatedData = $request->validate([
            'student_name'  => 'required|string|max:255',
            'project_type'  => 'required|string|max:255',
            'project_image' => 'nullable|image|max:2048', // Nullable saat edit
        ]);

        if ($request->hasFile('project_image')) {
            // Hapus gambar lama (project_image)
            if ($project->project_image && Storage::disk('public')->exists($project->project_image)) {
                Storage::disk('public')->delete($project->project_image);
            }
            $validatedData['project_image'] = $request->file('project_image')->store('student_projects', 'public');
        }

        $project->update($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diupdate!');
    }

    public function destroy(StudentProject $project)
    {
        if ($project->project_image && Storage::disk('public')->exists($project->project_image)) {
            Storage::disk('public')->delete($project->project_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus!');
    }
}