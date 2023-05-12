<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $created_at = $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null;

        return [

            'id' => $this->id,
            'title' => $this->title,
            'news_content' => $this->news_content,
            'created_at' => $created_at

        ];
    }
}