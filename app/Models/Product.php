<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'provider_id', 'vote_enabled', 'comment_enabled', 'edit_by_visitor_enabled'];

    public function setVoteEnabled($value)
    {
        $this->attributes['vote_enabled'] = in_array($value, [true, 'true', 1, '1']) ? 1 : 0;
    }

    public function setCommentEnabled($value)
    {
        $this->attributes['comment_enabled'] = in_array($value, [true, 'true', 1, '1']) ? 1 : 0;
    }

    public function setEditByVisitorEnabled($value)
    {
        $this->attributes['edit_by_visitor_enabled'] = in_array($value, [true, 'true', 1, '1']) ? 1 : 0;
    }
}
