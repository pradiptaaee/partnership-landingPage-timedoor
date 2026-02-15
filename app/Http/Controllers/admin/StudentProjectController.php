<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate; 

class StudentProjectController extends Controller
{
    // --- HELPER TRANSLATE (Logika Indo-First) ---
    private function processTranslation($inputArray)
    {
        // 1. Ambil input Bahasa Indonesia (id)
        $indoText = $inputArray['id'] ?? '';

        if (empty($indoText)) {
            return $inputArray;
        }

        $tr = new GoogleTranslate();

        // 2. Terjemahkan INDO -> INGGRIS (Jembatan Kualitas)
        $englishText = '';
        try {
            $tr->setSource('id'); 
            $tr->setTarget('en');
            $englishText = $tr->translate($indoText);
            
            // Simpan hasil Inggris ke array
            $inputArray['en'] = $englishText; 
        } catch (\Exception $e) {
            $englishText = $indoText; // Fallback
            $inputArray['en'] = $indoText;
        }

        // 3. Terjemahkan INGGRIS -> LAINNYA
        $targets = ['ms' => 'ms', 'fil' => 'tl', 'ja' => 'ja', 'ar' => 'ar', 'bn' => 'bn'];

        foreach ($targets as $laravelCode => $googleCode) {
            if (empty($inputArray[$laravelCode])) {
                try {
                    $tr->setSource('en'); 
                    $tr->setTarget($googleCode);
                    $inputArray[$laravelCode] = $tr->translate($englishText);
                } catch (\Exception $e) {
                    $inputArray[$laravelCode] = $englishText;
                }
            }
        }

        return $inputArray;
    }

    /**
     * Menampilkan List Project
     */
    public function index()
    {
        $projects = StudentProject::latest()->get();
        // PERBAIKAN PATH: Mengarah ke folder 'student_projects'
        return view('admin.landing_page.student_projects.index', compact('projects'));
    }

    /**
     * Menampilkan Form Create
     */
    public function create()
    {
        // PERBAIKAN PATH: Mengarah ke folder 'student_projects'
        return view('admin.landing_page.student_projects.create');
    }

    /**
     * Simpan Data Baru (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_image'   => 'required|image|max:2048',
            'student_name'    => 'required|string',
            'age'             => 'required|string',
            'project_type.id' => 'required|string', // Validasi input ID
        ]);

        // Proses Translate
        $types = $this->processTranslation($request->project_type);
        
        // Upload Gambar
        $imagePath = $request->file('project_image')->store('projects', 'public');

        StudentProject::create([
            'project_image' => $imagePath,
            'student_name'  => $request->student_name,
            'age'           => $request->age,
            'project_type'  => $types,
        ]);

        return redirect()->route('admin.projects.index')->with('success_message', 'Project berhasil dibuat!');
    }

    /**
     * Menampilkan Detail (Redirect ke Edit)
     */
    public function show($id)
    {
        return redirect()->route('admin.projects.edit', $id);
    }

    /**
     * Menampilkan Form Edit
     */
    public function edit(StudentProject $project)
    {
        // PERBAIKAN PATH: Mengarah ke folder 'student_projects'
        return view('admin.landing_page.student_projects.edit', compact('project'));
    }

    /**
     * Update Data
     */
    public function update(Request $request, StudentProject $project)
{
    $request->validate([
        'project_image'   => 'nullable|image|max:2048',
        'student_name'    => 'required|string',
        'age'             => 'required|string', 
        'project_type.id' => 'required|string',
    ]);

    // --- CARA MANUAL (MEMAKSA DATA MASUK) ---
    $project->student_name = $request->student_name;
    $project->age = $request->age; // Kita paksa isi kolom age
    
    // Proses Project Type (Translate)
    $types = $this->processTranslation($request->project_type);
    $project->project_type = $types;

    // Proses Gambar
    if ($request->hasFile('project_image')) {
        if ($project->project_image && Storage::disk('public')->exists($project->project_image)) {
            Storage::disk('public')->delete($project->project_image);
        }
        $project->project_image = $request->file('project_image')->store('projects', 'public');
    }

    $project->save(); // Simpan perubahan
    // ----------------------------------------

    return redirect()->route('admin.projects.index')->with('success_message', 'Project berhasil diperbarui!');
}

    /**
     * Hapus Data (DESTROY) - INI YANG TADI ANDA CARI
     */
    public function destroy(StudentProject $project)
    {
        // Hapus file gambar
        if ($project->project_image && Storage::disk('public')->exists($project->project_image)) {
            Storage::disk('public')->delete($project->project_image);
        }

        // Hapus record DB
        $project->delete();

        return redirect()->back()->with('success_message', 'Project berhasil dihapus!');
    }
}