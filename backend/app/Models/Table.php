<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $primaryKey = 'tbl_id';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sent',
        'message',
        'image'
    ];
}
