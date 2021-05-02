<?php

namespace App\Models;

use App\User;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'region_id',
        'user_id'
    ];

    public function region() {
        return $this->belongsTo(Region::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
