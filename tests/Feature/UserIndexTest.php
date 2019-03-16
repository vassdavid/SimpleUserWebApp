<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /**
      * test user api get
      * @return void
      */
     public function testGetUserAPI()
     {
        // Illuminate\Http\JsonResponse
        $response = $this->get('/api/user');

        //test get
        $response->assertStatus(200);

        //get response content (JSON format)
        $contentArray = $response->getData();
        // - (Array format)
        $contentJson = $response->content();

        //this is first page
        $this->assertEquals($contentArray->current_page, 1);

        //Illuminate/Database/Eloquent/Collection
        $collection = User::with('emails')->orderBy('id','DESC')->paginate(24);

        //validate data
        $this->assertEquals($contentJson, $collection->toJson());

     }

}
