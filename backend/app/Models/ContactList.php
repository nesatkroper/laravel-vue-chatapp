<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    use HasFactory;

    protected $primaryKey = 'ctl_id';

    protected $fillable = [
        'contact_id',
        'nickname',
        'phone',
        'description',
        'status',
        'is_delete'
    ];
}
