<?php

namespace App\Models;

use App\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
