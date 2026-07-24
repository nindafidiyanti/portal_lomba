<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forum extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'cabor', 'is_pinned'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ForumComment::class)->whereNull('parent_id')->orderBy('created_at', 'desc');
    }

    public function allComments(): HasMany
    {
        return $this->hasMany(ForumComment::class)->orderBy('created_at', 'asc');
    }

    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }
}
