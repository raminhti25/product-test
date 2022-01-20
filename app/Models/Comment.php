<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const APPROVED = 'approved';

    protected $fillable = ['product_id', 'user_id', 'description', 'status'];

    public function scopeApproved($query)
    {
        return $query->where('comments.status', self::APPROVED);
    }

    public function scopeProduct($query, int $product_id)
    {
        return $query->where('comments.product_id', $product_id);
    }
}
