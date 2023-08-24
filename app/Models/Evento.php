<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = [
        'data'
    ];

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
