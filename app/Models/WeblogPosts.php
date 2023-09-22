<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeblogPosts extends Model
{
    use HasFactory;

    protected $fillable = ["title" , "description" , "image" , "user_id"];

    public function user(){
        $this->belongsTo(User::class);
    }
}