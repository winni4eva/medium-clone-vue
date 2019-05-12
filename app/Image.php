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
    
     /**
     * Mutate image_path from absolute to relative path.
     *
     * @var array
     */
    public function getImagePathAttribute(string $imageUrl): string 
    {
        $urlSegemnts = explode(DIRECTORY_SEPARATOR, $imageUrl);

        if (in_array('public', $urlSegemnts)) {
            $key = array_search('public', $urlSegemnts);
            $imageUrl = implode(
                DIRECTORY_SEPARATOR, 
                array_slice($urlSegemnts, $key+1)
            );
        }
        
        return $imageUrl;
    }
}
