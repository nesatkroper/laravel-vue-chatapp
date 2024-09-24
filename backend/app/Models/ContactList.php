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
        'usr_id',
        'nickname',
        'phone',
        'description',
        'status',
        'is_delete'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'contact_id');
    }
}
