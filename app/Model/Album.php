<?php

namespace App\Model;

use App\Model\Audio;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	Protected $table = "albums";

    public function audios(){
    	return $this->hasMany(Audio::class);
    }
}
