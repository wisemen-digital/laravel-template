<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foo extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'name',
    ];

    public $dates = [
        'updated_at',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
