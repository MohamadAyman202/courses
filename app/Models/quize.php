<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quize extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin() {
        return $this->belongsto(Admin::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function quization()
    {
        return $this->hasMany(quization::class);
    }

}
