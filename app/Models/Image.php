<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable=['name' , 'image' ,'blogpost_id' , 'image' , 'type'];


    public function blogpost(){
        return $this->belongsTo(BlogPost::class);

    }

}
