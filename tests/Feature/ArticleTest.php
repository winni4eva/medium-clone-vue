<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DatabaseSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Article;
use App\Image;


class ArticleTest extends TestCase
{
    use RefreshDatabase;

    

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**
     * Test get articles endpoint.
     * 
     * @return void
     * @test 
     */
    public function can_fetch_articles()
    {
        
        $this->json('GET', 'api/articles')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    "articles" => [
                        "current_page",
                        "data" => [
                            [
                                "id","user_id","title","description","tags","created_at","updated_at",
                                "images"=>[
                                    ["id","article_id","image_path","created_at","updated_at"],
                                    ["id","article_id","image_path","created_at","updated_at"]],
                                "user"=>["id","email","email_verified_at","created_at","updated_at"]
                            ],
                            [
                                "id","user_id","title","description","tags","created_at","updated_at",
                                "images"=>[
                                    ["id","article_id","image_path","created_at","updated_at"],
                                    ["id","article_id","image_path","created_at","updated_at"]],
                                "user"=>["id","email","email_verified_at","created_at","updated_at"
                                ]
                            ],
                            [
                                "id","user_id","title","description","tags","created_at","updated_at","images"=>
                                [
                                    ["id","article_id","image_path","created_at","updated_at"],
                                    ["id","article_id","image_path","created_at","updated_at"]],
                                "user"=>["id","email","email_verified_at","created_at","updated_at"]
                            ]
                        ],
                        "first_page_url",
                        "from",
                        "next_page_url",
                        "path",
                        "per_page",
                        "prev_page_url",
                        "to"
                    ]
                ]
            );
    }

    /**
     * Test store article post validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_validation_errors_when_post_article_data_is_empty()
    {
        $this->json('POST', 'api/articles', [])
            ->assertJson(
                [
                    "message"=> "The given data was invalid.",
                    "errors"=> [
                        "title"=> ["The title field is required."],
                        "description"=> ["The description field is required."],
                        "tags" => ["The tags field is required."],
                        "images" => ["The images field is required."]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    /**
     * Test store article post title validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_title_validation_errors_when_post_article_data_has_no_title()
    {
        $article = [
            'title'=> '',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => [UploadedFile::fake()->image('the_greatest_world_icons.jpg')]
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJson(
                [
                    "message"=> "The given data was invalid.",
                    "errors"=> [
                        "title"=> ["The title field is required."]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    /**
     * Test store article post description validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_description_validation_errors_when_post_article_data_has_no_description()
    {
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => '',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => [UploadedFile::fake()->image('the_greatest_world_icons.jpg')]
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJson(
                [
                    "message"=> "The given data was invalid.",
                    "errors"=> [
                        "description"=> ["The description field is required."]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    /**
     * Test store article post tags validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_tags_validation_errors_when_post_article_tags_is_not_valid()
    {
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => 'Lets make the world a better place',
            'tags' => ['tags', 'should', 'be', 'a', 'json', 'string'],
            'images' => [UploadedFile::fake()->image('the_greatest_world_icons.jpg')]
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJsonStructure(
                [
                    "message",
                    'exception',
                    'file',
                    'line',
                ]
            )
            ->assertStatus(500);
    }

    /**
     * Test store article post tags validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_images_validation_errors_when_post_article_data_has_no_images()
    {
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => ''
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJson(
                [
                    "message"=> "The given data was invalid.",
                    "errors"=> [
                        "images"=> ["The images field is required."]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    /**
     * Test store article post array images validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_images_array_validation_errors_when_post_article_images_data_is_not_an_array()
    {
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => UploadedFile::fake()->create('document.pdf', 350),
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJson(
                [
                    "message"=> "The given data was invalid.",
                    "errors"=> [
                        "images"=> ["The images must be an array."]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    /**
     * Test store article post images mime validation errors.
     * 
     * @return void
     * @test 
     */
    public function should_return_images_mime_validation_errors_when_post_article_images_data_is_not_an_image()
    {
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => [UploadedFile::fake()->create('document.pdf', 350)],
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJson(
                [
                    "message" => "The given data was invalid.",
                    "errors" => [
                        "images.0" => [
                            "The images.0 must be an image.",
                            "The images.0 must be a file of type: jpeg, jpg, bmp, png."
                        ]
                    ]
                ]

            )
            ->assertStatus(422);
    }

    /**
     * Test store article post when not signed in.
     * 
     * @return void
     * @test 
     */
    public function should_throw_jwt_error_when_store_artilce_post_has_correct_data_but_user_is_not_logged_in()
    {
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => [
                $image1 = UploadedFile::fake()->image('avatar.jpg'),
                $image2 = UploadedFile::fake()->image('avatar2.jpg')
            ],
        ];

        $this->json('POST', 'api/articles', $article)
            ->assertJsonStructure(
                [
                    "message", 
                    "exception",                                 
                    "file",
                    "line",
                    "trace" => [ ]
                ]
            )
            ->assertStatus(500);
    }

    /**
     * Test store article post when signed in.
     * 
     * @return void
     * @test 
     */
    public function should_store_artilce_post_data_when_user_is_logged_in()
    {
        Storage::fake('public_uploads');
        $article = [
            'title'=> 'The Greatest Post Ever',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => [
                $image1 = UploadedFile::fake()->image('avatar.jpg'),
                $image2 = UploadedFile::fake()->image('avatar2.jpg')
            ],
        ];

        $file1 = 'article_images/' . $image1->hashName();
        $file2 = 'article_images/' . $image2->hashName();

        $this->clientPost('api/articles', $article)
            ->assertJson(
                [
                    "success" => "Article created successfully"
                ]
            )
            ->assertStatus(201);

        $this->assertDatabaseHas(
            'articles', [
                'title' => $article['title']
            ]
        );
        $this->assertDatabaseHas(
            'images', [
            'image_path' => $file1
            ]
        );
        Storage::disk('public_uploads')->assertExists($file1);
        Storage::disk('public_uploads')->assertExists($file2);

        Storage::disk('public_uploads')->delete($file1);
        Storage::disk('public_uploads')->delete($file2);
    }

    /**
     * Test store article put request.
     * 
     * @return void
     * @test 
     */
    public function should_update_artilce_data_when_article_id_is_added_to_post()
    {
        Storage::fake('public_uploads');
        $article = $this->createArticle();
        $article_update = [
            'id' => $article->first()->id,
            'title'=> 'I have been updated',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => [
                $image1 = UploadedFile::fake()->image('avatar.jpg'),
                $image2 = UploadedFile::fake()->image('avatar2.jpg')
            ],
        ];
        $file1 = 'article_images/' . $image1->hashName();
        $file2 = 'article_images/' . $image2->hashName();

        $this->clientPost('api/articles', $article_update)
            ->assertJson(
                [
                    "success" => "Article updated successfully"
                ]
            )
            ->assertStatus(201);

        $this->assertDatabaseHas(
            'articles', [
                'title' => $article_update['title']
            ]
        );
        $this->assertDatabaseHas(
            'images', [
            'image_path' => $file1
            ]
        );
        Storage::disk('public_uploads')->assertExists($file1);
        Storage::disk('public_uploads')->assertExists($file2);

        Storage::disk('public_uploads')->delete($file1);
        Storage::disk('public_uploads')->delete($file2);
    }

    /**
     * Test store article delete request.
     * 
     * @return void
     * @test 
     */
    public function should_delete_artilce_data_when_a_delete_request_is_sent()
    {
        $article = $this->createArticle();
        $articleId = $article->first()->id;

        $this->delete('api/articles/'.$articleId)
            ->assertJson(
                [
                    "success" => "Article removed successfully"
                ]
            )
            ->assertStatus(201);

        $this->assertDatabaseMissing(
            'articles', [
                'title' => $article->first()->title
            ]
        );
    }

    protected function createArticle()
    {
        return factory(Article::class, 3)
            ->create(
                [
                    'user_id' => User::first()->id
                ]
            )
            ->each( 
                function (Article $article) {
                    factory(Image::class, 2)
                        ->create(
                            [
                                'article_id' => $article->id,
                            ]
                        );
                }
            );
    }
}
