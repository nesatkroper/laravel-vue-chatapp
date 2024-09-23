<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableList extends Model
{
    use HasFactory;

    protected $primaryKey = 'tb_id';

    protected $fillable = [
        'member_id_1',
        'member_id_2',
        'table_name',
        'description',
        'status',
        'is_delete'
    ];
}
