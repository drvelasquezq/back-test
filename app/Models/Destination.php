<?php

namespace App\Models;

use App\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'sales_strategy',
        'latitude',
        'longitude',
        'department_id',
        'user_id'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
