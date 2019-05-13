<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use DatabaseSeeder;
use App\Image;

class ImageTest extends TestCase
{

    use RefreshDatabase;

    protected $image;

    public function setUp(): void
    {
        parent::setUp();
        $this->image = app()->make(Image::class);
        $this->seed('DatabaseSeeder');
    }

    /**
     * Get cleaned image path.
     *
     * @test
     * @return void
     */
    public function can_clean_image_path_urls()
    {
        $imagePath = '/var/www/my-dummy-project/public/images/my-awesome-image.png';

        $cleaneImagePath = $this->image->getImagePathAttribute($imagePath);
        
        $this->assertEquals('images/my-awesome-image.png', $cleaneImagePath);
    }

}
