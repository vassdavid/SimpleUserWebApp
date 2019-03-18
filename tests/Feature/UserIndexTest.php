<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\Paginator;

class UserIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /**
      * test user api (get)
      * @return void
      */
     public function testGetUserAPI()
     {
        // Illuminate\Http\JsonResponse
        // get users by http get
        $response = $this->get('/api/user');
        // Illuminate/Database/Eloquent/Collection
        // get collection
        $collection = User::with('emails')->orderBy('id','DESC')->paginate(24);

        //test get
        $response->assertStatus(200);

        //get response content (JSON format)
        $contentJson = $response->content();
        // - (Array format)
        $contentArray = $response->getData();

        //this is first page
        $this->assertEquals($contentArray->current_page, 1);

        //validate data
        $this->assertEquals($contentJson, $collection->toJson());

     }

     /**
      * @test
      * Test user api pagination
      * @return void
      */
     public function testPagination() {

       $currentPage = 2;
       //get specified page
       Paginator::currentPageResolver(function () use ($currentPage) {
          return $currentPage;
      });


      $response = $this->get('/api/user?page=' . $currentPage);
      
      //Illuminate/Database/Eloquent/Collection
      $collection = User::with('emails')->orderBy('id','DESC')->paginate(24);

      //test get
      $response->assertStatus(200);

      //get response content (JSON format)
      $contentJson = $response->content();
      // - (Array format)
      $contentArray = $response->getData();

      //this is first page
      $this->assertEquals($contentArray->current_page, $currentPage);

      //validate data
      $this->assertEquals($contentJson, $collection->toJson());

     }

}
