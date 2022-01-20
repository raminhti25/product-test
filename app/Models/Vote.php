<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const APPROVED = 'approved';

    protected $fillable = ['product_id', 'user_id', 'value', 'status'];

    public function scopeApproved($query)
    {
        return $query->where('votes.status', self::APPROVED);
    }

    public function scopeProduct($query, int $product_id)
    {
        return $query->where('votes.product_id', $product_id);
    }
}
