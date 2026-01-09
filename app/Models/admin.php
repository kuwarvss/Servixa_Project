<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = [];

    protected $table = 'admins';
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
        'force_password_change',
        'password_created_at',
    ];

    protected $hidden = [
        'password',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'admin_id');
    }
}



