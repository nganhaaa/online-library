<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'description' => $this->description,
            'publication_year' => $this->publication_year,
            'available' => $this->available,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'image' => $this->image,
            'age_group' => new AgeGroupResource($this->whenLoaded('ageGroup')),
            'publisher' => new PublisherResource($this->whenLoaded('publisher')),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
        ];
    }
}
