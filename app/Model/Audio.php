<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    Protected $table = "audio";

    public function album(){
    	return $this->belongsTo(Album::class);
    }
}
