<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['createdDate'];

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function user() {
       return $this->belongsTo(User::class);
    }

    public function createPost(Request $request) {
        
    }
}
