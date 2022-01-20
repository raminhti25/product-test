<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private $comments;
    private $votes_average;
    private $total_comments;

    public function __construct($resource, array $params=[])
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;

        list('comments' => $this->comments, 'votes_average' => $this->votes_average, 'total_comments' => $this->total_comments) = $params;
    }

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
            'name' => $this->name,
            'provider_id' => $this->provider_id,
            'can_vote' => $this->vote_enabled,
            'can_comment' => $this->comment_enabled,
            'can_visitor_change' => $this->edit_by_visitor_enabled,
            'comments' => $this->comments,
            'votes_average' => $this->votes_average,
            'total_comments' => $this->total_comments,
        ];
    }
}
