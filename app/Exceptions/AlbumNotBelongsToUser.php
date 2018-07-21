<?php

namespace App\Exceptions;

use Exception;

class AlbumNotBelongsToUser extends Exception
{
    public function render(){
    	return ['errors' => 'Album Not Belongs to User'];
    }
}
