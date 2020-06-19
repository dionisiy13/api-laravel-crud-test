<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The model to use when creating dummy data.
     *
     * @var class
     */
    protected $model = User::class;

    /**
     * The endpoint to query in the API
     * e.g = /api/<endpoint>.
     *
     * @var string
     */
    protected $endpoint = 'user';

    /**
     * Uses the model factory to generate a fake entry.
     *
     * @return class
     */
    public function createPost()
    {
        return factory(\App\User::class)->create();
    }

    /**
     * GET /endpoint/
     * Should return 200 with data array.
     */
    public function testIndex()
    {
        $response = $this->json('GET', "/api/{$this->endpoint}");
        $response
            ->assertStatus(200);
    }

    /**
     * GET /endpoint/<id>
     * Should return 200 with data array.
     */
    public function testShow()
    {
        // Create a test shop with filled out fields
        $obj = $this->createPost();
        // Check the API for the new entry
        $response = $this->json('GET', "api/{$this->endpoint}/{$obj->id}");
        // Delete the test shop
        $obj->delete();
        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $obj->id,
            ]);
    }

    /**
     * POST /endpoint/.
     */
    public function testStore()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'email' => $faker->unique()->safeEmail,
            'name' => $faker->name,
            'birth' => $faker->dateTime->format('Y-m-d'),
            'password' => 'secret1234',
            'password_repeat' => 'secret1234',
        ];

        $response = $this->json('POST', "api/{$this->endpoint}", $data);

        ($this->model)::where('email', $data['email'])->delete();
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    /**
     * PUT /endpoint/.
     */
    public function testUpdate()
    {
        $obj = $this->createPost();
        $obj = $obj->toArray();
        $faker = \Faker\Factory::create();
        $obj['email'] = $faker->unique()->safeEmail();

        $response = $this->json('PUT', "api/{$this->endpoint}/{$obj['id']}", ['email' => $obj['email']]);

        ($this->model)::where('email', $obj['email'])->delete();
        $response
            ->assertStatus(200)
            ->assertJson([
                'email' => $obj['email'],
            ]);
    }

    /**
     * DELETE /endpoint/<id>
     * Tests the destroy() method that deletes the shop.
     */
    public function testDestroy()
    {
        $activity = $this->createPost();
        $response = $this->json('DELETE', "api/{$this->endpoint}/{$activity->id}");
        $response
            ->assertStatus(202);
    }
}
