<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'msg_id';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sent',
        'message',
        'image',
        'status',
        'is_delete'
    ];
}
