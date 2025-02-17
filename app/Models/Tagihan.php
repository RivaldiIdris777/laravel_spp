<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tagihan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['date' => 'tanggal_tagihan'];
    protected $with = ['user', 'siswa','tagihanDetails'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tagihanDetails(): HasMany
    {
        return $this->hasMany(TagihanDetail::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });

        static::updating(function($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });
    }


}
