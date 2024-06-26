<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    use HasFactory;

    protected $guarded =[
        'name',
        'slug',
        'icon',
        'background_color',
        'text_color',
        'meta_title',
        'meta_description',
        'image',
        'image_alt'
    ];
}
