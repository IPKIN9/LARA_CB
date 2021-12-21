<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutingModel extends Model
{
    protected $table = 'routing';
    protected $fillable = [
        'id', 'type_route', 'button_click', 'message_response',
        'next_response', 'created_at', 'updated_at'
    ];

    public function detail()
    {
        return $this->belongsTo(DetailModel::class, 'button_click');
    }

    public function message()
    {
        return $this->belongsTo(MessageModel::class, 'message_response');
    }

    public function next_message()
    {
        return $this->belongsTo(ChoiceModel::class, 'next_response');
    }

    use HasFactory;
}
