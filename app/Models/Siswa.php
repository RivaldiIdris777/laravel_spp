<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class Siswa extends Model
{
    use HasFactory;
    use SearchableTrait;
    protected $guarded = [];
    
    protected $searchable = [       
        'columns' => [
            'nama' => 10,
            'nisn' => 10,
        ],        
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wali(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_id')->withDefault([
            'name' => 'Belum ada wali murid'
        ]);
    }
}
