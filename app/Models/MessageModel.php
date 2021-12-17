<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'message';
    protected $fillable = [
        'id', 'content', 'type_message', 'created_at', 'updated_at'
    ];

    use HasFactory;
}
