<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate; 

class TestimonialController extends Controller
{
    private function processTranslation($inputArray)
    {
        $indoText = $inputArray['id'] ?? '';
        if (empty($indoText)) return $inputArray;

        $tr = new GoogleTranslate();

        // Indo -> Inggris
        $englishText = '';
        try {
            $tr->setSource('id'); $tr->setTarget('en');
            $englishText = $tr->translate($indoText);
            $inputArray['en'] = $englishText; 
        } catch (\Exception $e) { $englishText = $indoText; $inputArray['en'] = $indoText; }

        // Inggris -> Lainnya
        $targets = ['ms' => 'ms', 'fil' => 'tl', 'ja' => 'ja', 'ar' => 'ar', 'bn' => 'bn'];
        foreach ($targets as $lc => $gc) {
            if (empty($inputArray[$lc])) {
                try {
                    $tr->setSource('en'); $tr->setTarget($gc);
                    $inputArray[$lc] = $tr->translate($englishText);
                } catch (\Exception $e) { $inputArray[$lc] = $englishText; }
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
            'parent_image' => 'required|image|max:2048',
            'parent_name'  => 'required|string',
            'student_name' => 'required|string',
            'course_name'  => 'required|string',
            'review.id'    => 'required|string', // Validasi ID
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

        return redirect()->route('admin.testimonials.index')->with('success_message', 'Testimoni dibuat!');
    }

    public function show(Testimonial $testimonial)
    {
        return redirect()->route('admin.testimonials.edit', $testimonial->id);
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.landing_page.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'parent_image' => 'nullable|image|max:2048',
            'parent_name'  => 'required|string',
            'student_name' => 'required|string',
            'course_name'  => 'required|string',
            'review.id'    => 'required|string',
        ]);

        $data = $request->except(['parent_image', 'review']);
        $reviews = $this->processTranslation($request->review);
        $data['review'] = $reviews;

        if ($request->hasFile('parent_image')) {
            if ($testimonial->parent_image && Storage::disk('public')->exists($testimonial->parent_image)) {
                Storage::disk('public')->delete($testimonial->parent_image);
            }
            $data['parent_image'] = $request->file('parent_image')->store('testimonials', 'public');
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success_message', 'Testimoni diupdate!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->parent_image && Storage::disk('public')->exists($testimonial->parent_image)) {
            Storage::disk('public')->delete($testimonial->parent_image);
        }
        $testimonial->delete();
        return redirect()->back()->with('success_message', 'Testimoni dihapus!');
    }
}