<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    protected $table = 'detail';
    protected $fillable = [
        'id', 'choice_id', 'content',
        'created_at', 'updated_at'
    ];

    public function choice()
    {
        return $this->belongsTo(ChoiceModel::class, 'choice_id');
    }

    use HasFactory;
}
