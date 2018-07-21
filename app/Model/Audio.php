<?php

namespace App\Model;

use App\Model\Album;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    Protected $table = "audio";

    public function album(){
    	return $this->belongsTo(Album::class);
    }
}
