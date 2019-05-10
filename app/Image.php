<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'image_path'];
}
