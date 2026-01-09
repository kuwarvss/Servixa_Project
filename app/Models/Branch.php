<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Branch extends Model
{
    use SoftDeletes;
    
    protected $table = 'branches';
    protected $fillable = [
        'admin_id',
        'branch_name',
        'branch_code',
        'branch_address',
        'branch_phone',
        'branch_email',
        'opening_time',
        'closing_time',
        'capacity',
        'status',
        'is_default',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
