<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
    'parent_name', 
    'student_name', 
    'course_name', 
    'review', 
    'parent_image'
    ];
}
