<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'aliases',
        'icon',
        'avatar',
        'meta_title',
        'meta_description',
        'image',
        'image_alt',
    ];
    public $timestamps = false;
    protected $casts = [
        'aliases' => 'array',  // Cast the 'aliases' attribute to an array
    ];
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

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
