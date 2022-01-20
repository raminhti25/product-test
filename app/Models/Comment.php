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
}
