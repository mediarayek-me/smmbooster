<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase
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
   public function an_admin_can_read_all_the_admins_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $new_admin = Admin::factory()->create();
       $response = $this->get('/admin/admins?api=true');
       $response->assertSee($new_admin->email);
   }

    /** @test */
    
    public function an_admin_can_see_admins_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/admins');
        $response->assertViewIs('admin.admins');
    }

    /** @test */
    public function an_admin_can_search_in_admins(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/admins?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_admin(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $new_admin  = Admin::factory()->create();
        $response = $this->get('/admin/admins/'.$new_admin->id);
        $response->assertSee($new_admin->name)->assertSee($new_admin->id);
    }

    /** @test */
    public function an_admin_can_create_a_new_admin(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $new_admin = Admin::factory()->make();
        $new_admin = $new_admin->makeVisible('password')->toArray();
        $this->post('/admin/admins',$new_admin);
        $this->assertDatabaseHas('admins',['username'=> $new_admin['username'],'firstname'=>$new_admin['firstname']]);

    }

    /** @test */
    public function an_admin_can_update_admin(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $new_admin = Admin::factory()->create();
        $this->put('/admin/admins/'.$new_admin->id,['firstname'=>'new_firstname']);
        $this->assertDatabaseHas('admins',['id'=> $new_admin->id,'firstname'=>'new_firstname']);
    }

    /** @test */
    public function an_admin_can_delete_admin(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $new_admin = Admin::factory()->create();
        $this->delete('/admin/admins/'.$new_admin->id);
        $this->assertDatabaseMissing('admins',['id'=> $new_admin->id]);
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_admin(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->post('/admin/admins',$admin->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_admins(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/admins')
        ->assertRedirect('/admin/login');
     }

   
}
