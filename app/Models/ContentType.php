<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContentType extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'background_color',
        'text_color',
        'meta_title',
        'meta_description',
        'image',
        'image_alt',
    ];

    public $timestamps = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = fake()->uuid();
            }
        });
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
