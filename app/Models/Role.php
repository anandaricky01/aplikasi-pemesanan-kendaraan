<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user(){
        return $this->hasMany(User::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($role) { // before delete() method call this
             $role->user()->each(function($user) {
                $user->delete(); // <-- direct deletion
             });
             // do the rest of the cleanup...
        });
    }
}
