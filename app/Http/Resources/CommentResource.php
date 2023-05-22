<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $created_at = $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null;
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'comments_content' => $this->comments_content,
            'created_at' => $created_at,
            'commentator' => $this->commentator,

        ];
    }
}
