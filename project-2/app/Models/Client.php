<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'user_id', 'contact_person'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
