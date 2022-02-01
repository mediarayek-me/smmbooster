<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
   //use RefreshDatabase;
  use DatabaseMigrations;

  public function setUp():void
  {
     parent::setUp();

     // seed database
     $seeder = new DatabaseSeeder();
     $seeder->run();
  }

    /** @test */
   public function an_admin_can_read_all_the_categories_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $category = Category::factory()->create();
       $response = $this->get('/admin/categories?api=true');
       $response->assertSee($category->id);
   }

    /** @test */
    
    public function an_admin_can_see_categories_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $category = Category::factory()->create();
        $response = $this->get('/admin/categories');
        $response->assertViewIs('admin.categories');
    }

    /** @test */
    public function an_admin_can_search_in_categories(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/categories?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_category(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $category  = Category::factory()->create();
        $response = $this->get('/admin/categories/'.$category->id);
        $response->assertSee($category->name)->assertSee($category->id);
    }

    /** @test */
    public function an_admin_can_create_a_new_category(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $category = Category::factory()->make();
        $this->post('/admin/categories',$category->toArray());
        $this->assertDatabaseHas('categories',['name'=> $category['name']]);

    }

    /** @test */
    public function an_admin_can_update_category(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $category = Category::factory()->create();
        $this->put('/admin/categories/'.$category->id,['name'=>'new_name']);
        $this->assertDatabaseHas('categories',['id'=> $category->id,'name'=>'new_name']);

    }

    /** @test */
    public function an_admin_can_delete_category(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $category = Category::factory()->create();
        $this->delete('/admin/categories/'.$category->id);
        $this->assertDatabaseMissing('categories',['id'=> $category->id]);
    }

    /** @test */
    public function an_admin_can_delete_services(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $category = Category::factory()->create();
        $service = 
        [
            'name' => 'demo',
            'category_id' => $category->id,
            'type' => 'normal',
            'status' => 'active',
            'rate'=> 1000,
            'min' => 10,
            'max' => 10000,
            'percentage_increase' => 20,
        ];
        $service = Service::factory()->create($service);
        $this->delete('/admin/categories/'.$category->id);
        $this->assertDatabaseMissing('categories',['id'=> $category->id]);
        $this->assertDatabaseMissing('services',['category_id'=> $category->id]);
    }


    /** @test */
    public function unauthenticated_users_cannot_create_a_new_category(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $category = Category::factory()->create();
        $this->post('/admin/categories',$category->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_categories(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/categories')
        ->assertRedirect('/admin/login');
     }

   
}
