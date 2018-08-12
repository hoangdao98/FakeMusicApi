<?php

namespace App\Http\Resources\Album;

use Illuminate\Http\Resources\Json\Resource;

class AlbumCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'singer' => $this->singer,
            'year'=> $this->year,
            'description' => $this->description,
            'image' => $this->image == 0 ? 'Out of Image' : asset('upload/' . $this->image),
            'href' => [
                'audios' => route('albums.show', $this->id),
            ],
        ];

    }
}
