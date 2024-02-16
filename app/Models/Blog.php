<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable=['title','body','blog_category_id','user_id'];

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function category_id(){

        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }
}
