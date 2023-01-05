<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $table = 'todolists';

    protected $fillable = [
        'is_done',
        'user_id',
        'created_at',
        'title',
        'content'
    ];

    protected function isDone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value !== '0',
            set: fn ($value) => $value ? '1' : '0'
        );
    }
}
