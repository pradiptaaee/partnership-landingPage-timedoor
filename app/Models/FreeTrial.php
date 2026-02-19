<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeTrial extends Model
{
    use HasFactory;

    protected $fillable = [
    'prefix', 'name', 'country', 'phone', 'email', 'kids_list', 'message'
    ];
}