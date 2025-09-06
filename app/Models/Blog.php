<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_published',
    ];

    protected $withTrashed = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
