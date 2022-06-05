<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->hashid(),
            "imdb_id" => $this->imdb_id,
            "title" => $this->title,
            "year" => $this->year,
            "rating" => $this->rating,
            "rating_count" => $this->rating_count,
            "description" => $this->description,
            "genre_id" => $this->genre->hashid(),
            "keywords" => $this->keywords,
//            "thumbnailUrl" => route("movie.thumbnail", ["id" => $this->hashid()]),
            "thumbnailUrl" => $this->image->filename,
        ];
    }
}
