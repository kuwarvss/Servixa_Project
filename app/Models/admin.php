<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'password',
        'status',
        'admin_image',
        'id_type',
        'id_number',
        'address',
    ];

    protected $hidden = [
        'password',
    ];
}



