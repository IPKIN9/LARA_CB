<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoiceModel extends Model
{
    protected $table = 'choice';
    protected $fillable = [
        'id', 'content', 'created_at', 'updated_at'
    ];

    use HasFactory;
}
