<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quization extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin() {
        return $this->belongsto(Admin::class);
    }

    public function quize(){
        return $this->belongsTo(quize::class);
    }
}
