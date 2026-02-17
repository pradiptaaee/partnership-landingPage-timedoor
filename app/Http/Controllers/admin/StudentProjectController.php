<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate; 

class StudentProjectController extends Controller
{
    /**
     * Memproses terjemahan otomatis menggunakan Google Translate.
     * Alur: Bahasa Indonesia -> Inggris -> Bahasa lainnya (MS, FIL, JA, AR, BN).
     */
    private function processTranslation($inputArray)
    {
        $indoText = $inputArray['id'] ?? '';

        if (empty($indoText)) {
            return $inputArray;
        }

        $tr = new GoogleTranslate();

        // Tahap 1: Terjemahkan dari Indonesia ke Inggris sebagai basis utama
        try {
            $tr->setSource('id')->setTarget('en');
            $englishText = $tr->translate($indoText);
            $inputArray['en'] = $englishText; 
        } catch (\Exception $e) {
            $englishText = $indoText;
            $inputArray['en'] = $indoText;
        }

        // Tahap 2: Terjemahkan dari Inggris ke bahasa target lainnya
        $targets = [
            'ms'  => 'ms', 
            'fil' => 'tl', 
            'ja'  => 'ja', 
            'ar'  => 'ar', 
            'bn'  => 'bn'
        ];

        foreach ($targets as $laravelCode => $googleCode) {
            if (empty($inputArray[$laravelCode])) {
                try {
                    $tr->setSource('en')->setTarget($googleCode);
                    $inputArray[$laravelCode] = $tr->translate($englishText);
                } catch (\Exception $e) {
                    $inputArray[$laravelCode] = $englishText;
                }
            }
        }

        return $inputArray;
    }

    /**
     * Menampilkan daftar proyek siswa.
     */
    public function index()
    {
        $projects = StudentProject::latest()->get();
        return view('admin.landing_page.student_projects.index', compact('projects'));
    }

    /**
     * Menampilkan formulir tambah proyek siswa.
     */
    public function create()
    {
        return view('admin.landing_page.student_projects.create');
    }

    /**
     * Menyimpan proyek baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_image'   => 'required|image|max:2048',
            'student_name'    => 'required|string',
            'age'             => 'required|string',
            'project_type.id' => 'required|string',
        ]);

        // Proses otomatisasi bahasa
        $types = $this->processTranslation($request->project_type);
        
        // Manajemen unggah gambar
        $imagePath = $request->file('project_image')->store('projects', 'public');

        StudentProject::create([
            'project_image' => $imagePath,
            'student_name'  => $request->student_name,
            'age'           => $request->age,
            'project_type'  => $types,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success_message', 'Project berhasil dibuat!');
    }

    /**
     * Mengarahkan detail proyek ke halaman edit.
     */
    public function show($id)
    {
        return redirect()->route('admin.projects.edit', $id);
    }

    /**
     * Menampilkan formulir ubah data proyek.
     */
    public function edit(StudentProject $project)
    {
        return view('admin.landing_page.student_projects.edit', compact('project'));
    }

    /**
     * Memperbarui data proyek di database.
     */
    public function update(Request $request, StudentProject $project)
    {
        $request->validate([
            'project_image'   => 'nullable|image|max:2048',
            'student_name'    => 'required|string',
            'age'             => 'required|string', 
            'project_type.id' => 'required|string',
        ]);

        // Update atribut dasar
        $project->student_name = $request->student_name;
        $project->age = $request->age;
        
        // Update tipe proyek dengan terjemahan baru
        $project->project_type = $this->processTranslation($request->project_type);

        // Update gambar jika terdapat file baru yang diunggah
        if ($request->hasFile('project_image')) {
            if ($project->project_image && Storage::disk('public')->exists($project->project_image)) {
                Storage::disk('public')->delete($project->project_image);
            }
            $project->project_image = $request->file('project_image')->store('projects', 'public');
        }

        $project->save();

        return redirect()->route('admin.projects.index')
            ->with('success_message', 'Project berhasil diperbarui!');
    }

    /**
     * Menghapus data proyek dan file gambar terkait.
     */
    public function destroy(StudentProject $project)
    {
        if ($project->project_image && Storage::disk('public')->exists($project->project_image)) {
            Storage::disk('public')->delete($project->project_image);
        }

        $project->delete();

        return redirect()->back()
            ->with('success_message', 'Project berhasil dihapus!');
    }
}