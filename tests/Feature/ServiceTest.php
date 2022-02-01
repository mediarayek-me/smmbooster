<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Category;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServiceTest extends TestCase
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
   public function an_admin_can_read_all_the_services_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       Category::factory()->count(10)->create();
       $service = Service::factory()->create();
       $response = $this->get('/admin/services?api=true');
       $response->assertSee($service->name);
   }

    /** @test */
    
    public function an_admin_can_see_services_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        Category::factory()->count(10)->create();
        $service = Service::factory()->create();
        $response = $this->get('/admin/services');
        $response->assertViewIs('admin.services');
    }

    /** @test */
    public function an_admin_can_search_in_services(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/services?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        Category::factory()->count(10)->create();
        $service  = Service::factory()->create();
        $response = $this->get('/admin/services/'.$service->id);
        $response->assertSee($service->name)->assertSee($service->id);
    }

    /** @test */
    public function authenticated_admins_can_create_a_new_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        Category::factory()->count(10)->create();
        $service = Service::factory()->make();
        $this->post('/admin/services',$service->toArray());
        $this->assertDatabaseHas('services',['name'=> $service->name , 'category_id' => $service->category_id]);
    }
    
     /** @test */
     public function an_admin_can_update_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        Category::factory()->count(10)->create();
        $service = Service::factory()->create();
        $this->put('/admin/services/'.$service->id,['name'=>'new_name']);
        $this->assertDatabaseHas('services',['id'=> $service->id , 'name' => 'new_name']);
    }

    /** @test */
    public function an_admin_can_delete_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        Category::factory()->count(10)->create();
        $service = Service::factory()->create();
        $this->delete('/admin/services/'.$service->id);
        $this->assertDatabaseMissing('services',['id'=> $service->id]);
    }

    /** @test */
     public function unauthenticated_users_cannot_create_a_new_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        Category::factory()->count(10)->create();
        $service = Service::factory()->create();
        $this->post('/admin/services',$service->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_services(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/services')
        ->assertRedirect('/admin/login');
     }
     /** @test */
    public function regular_user_cant_create_a_new_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
         $this->actingAs($user,'web');
        Category::factory()->count(10)->create();
        $service = Service::factory()->make();
        $response = $this->post('/admin/services',$service->toArray());
        $response->assertStatus(302);
    }

    /** @test */
    public function regular_user_cant_update_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user,'web');
        Category::factory()->count(10)->create();
        $service = Service::factory()->create();
        $response = $this->put('/admin/services/'.$service->id,['name'=>'new_name']);
        $response->assertStatus(302);
    }

    /** @test */
    public function regular_user_cant_delete_service(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user,'web');
        Category::factory()->count(10)->create();
        $service = Service::factory()->create();
        $response = $this->delete('/admin/services/'.$service->id);
        $response->assertStatus(302);
    }
      

}

//https://5balloons.info/laravel-tdd-beginner-crud-example/
