<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'partner_id' => 'required|exists:partners,id',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:200',
            'full_description' => 'required|string',
            'activity_date' => 'required|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'partner_id.required' => 'Partner wajib dipilih.',
            'partner_id.exists' => 'Partner tidak valid.',
            'title.required' => 'Judul kegiatan wajib diisi.',
            'title.max' => 'Judul kegiatan maksimal 255 karakter.',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'short_description.max' => 'Deskripsi singkat maksimal 200 karakter.',
            'full_description.required' => 'Deskripsi lengkap wajib diisi.',
            'activity_date.required' => 'Tanggal kegiatan wajib diisi.',
            'activity_date.date' => 'Format tanggal tidak valid.',
            'featured_image.image' => 'File harus berupa gambar.',
            'featured_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'featured_image.max' => 'Ukuran gambar maksimal 2MB.',
            'photos.*.image' => 'Semua file harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'photos.*.max' => 'Ukuran setiap gambar maksimal 2MB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'partner_id' => 'partner',
            'title' => 'judul kegiatan',
            'short_description' => 'deskripsi singkat',
            'full_description' => 'deskripsi lengkap',
            'activity_date' => 'tanggal kegiatan',
            'featured_image' => 'gambar utama',
            'photos.*' => 'foto galeri',
        ];
    }
}