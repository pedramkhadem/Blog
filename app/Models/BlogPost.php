<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'slug' , 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class , 'blogpost_id')->whereNull('parent_id');
    }
    public function images(){
        return $this->hasMany(Image::class,'blogpost_id')->where('type','=' ,'gallery');
    }

    public function image(){
        return $this->hasOne(Image::class,'blogpost_id')->where('type','=' ,'thumbnail');
    }
}
