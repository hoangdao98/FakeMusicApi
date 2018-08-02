<?php

namespace App\Http\Resources\Album;

use App\Model\Album;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
            'description' => $this->description,
            'image' => $this->image == 0 ? 'Out of Image' : $this->image,
            'href' => [
                'audios' => route('audio.index', $this->id),
            ],
        ];
    }
}
