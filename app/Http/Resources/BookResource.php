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
            'age_group' => $this->whenLoaded('ageGroup', function () {
                return $this->ageGroup->name;
            }),
            'publisher' => $this->whenLoaded('publisher', function () {
                return $this->publisher->name;
            }),
            'authors' => $this->whenLoaded('authors', function () {
                return $this->authors->pluck('name');
            }),
            'genres' => $this->whenLoaded('genres', function () {
                return $this->genres->pluck('name');
            }),
        ];
    }
}
