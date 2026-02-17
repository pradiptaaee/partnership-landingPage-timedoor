<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TestimonialController extends Controller
{
    /**
     * Logika translasi otomatis (ID -> EN -> Global)
     */
    private function processTranslation($inputArray)
    {
        $indoText = $inputArray['id'] ?? '';
        if (empty($indoText)) return $inputArray;

        $tr = new GoogleTranslate();

        // Step 1: Terjemahkan ke Inggris sebagai bahasa perantara
        try {
            $tr->setSource('id')->setTarget('en');
            $englishText = $tr->translate($indoText);
            $inputArray['en'] = $englishText;
        } catch (\Exception $e) {
            $englishText = $indoText;
            $inputArray['en'] = $indoText;
        }

        // Step 2: Terjemahkan ke bahasa lainnya dari teks Inggris
        $targets = ['ms' => 'ms', 'fil' => 'tl', 'ja' => 'ja', 'ar' => 'ar', 'bn' => 'bn'];
        foreach ($targets as $lc => $gc) {
            if (empty($inputArray[$lc])) {
                try {
                    $tr->setSource('en')->setTarget($gc);
                    $inputArray[$lc] = $tr->translate($englishText);
                } catch (\Exception $e) {
                    $inputArray[$lc] = $englishText;
                }
            }
        }

        return $inputArray;
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.landing_page.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.landing_page.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'parent_name'  => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'course_name'  => 'required|string|max:255',
            'review.id'    => 'required|string',
        ]);

        $reviews = $this->processTranslation($request->review);
        $imagePath = $request->file('parent_image')->store('testimonials', 'public');

        Testimonial::create([
            'parent_image' => $imagePath,
            'parent_name'  => $request->parent_name,
            'student_name' => $request->student_name,
            'course_name'  => $request->course_name,
            'review'       => $reviews,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success_message', 'Testimoni berhasil dibuat!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.landing_page.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'parent_image' => 'nullable|image|max:2048',
            'parent_name'  => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'course_name'  => 'required|string|max:255',
            'review.id'    => 'required|string',
        ]);

        $reviews = $this->processTranslation($request->review);
        
        $data = [
            'parent_name'  => $request->parent_name,
            'student_name' => $request->student_name,
            'course_name'  => $request->course_name,
            'review'       => $reviews,
        ];

        if ($request->hasFile('parent_image')) {
            // Hapus foto lama
            if ($testimonial->parent_image) {
                Storage::disk('public')->delete($testimonial->parent_image);
            }
            $data['parent_image'] = $request->file('parent_image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success_message', 'Testimoni diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->parent_image) {
            Storage::disk('public')->delete($testimonial->parent_image);
        }
        
        $testimonial->delete();
        
        return redirect()->back()->with('success_message', 'Testimoni dihapus!');
    }
}