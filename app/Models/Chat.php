<?php

namespace App\Models;

use App\Enums\AccessType;
use App\Enums\ChatType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// enums - https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
class Chat extends Model
{
    use HasFactory;

    protected $casts = [
        'access_type' => AccessType::class,
        'type' => ChatType::class,
    ];

    protected $guarded = [
        'chat_id',
        'user_id',
        'language_id',
        'username',
        'name',
        'description',
        'access_type',
        'type',
        'avatar',
        'is_published',
        'invite_link',
        'avg_views',
        'subscribers',
        'meta_title',
        'meta_description',
        'image',
        'image_alt',
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
