<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShow extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'auhtor' => $this->user->name,
            'title' => $this->title,
            'body' => $this->body,
            'comment' => $this->comments,
            'created_at' => $this->created_at->format("d-m-y"),
            'updated_at' => $this->updated_at->format("d-m-y"),
        ];
    }
}
