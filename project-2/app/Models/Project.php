<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'client_id','description', 'status', 'deadline'];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function timelogs() {
        return $this->hasMany(TimeLog::class);
    }
}
