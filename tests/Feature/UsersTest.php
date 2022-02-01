<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
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
   public function an_admin_can_read_all_the_users_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $user = User::factory()->create();
       $response = $this->get('/admin/users?api=true');
       $response->assertSee($user->firstname);
   }

    /** @test */
    
    public function an_admin_can_see_users_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $response = $this->get('/admin/users');
        $response->assertViewIs('admin.users');
    }

    /** @test */
    public function an_admin_can_search_in_users(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/users?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_user(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user  = User::factory()->create();
        $response = $this->get('/admin/users/'.$user->id);
        $response->assertSee($user->name)->assertSee($user->id);
    }

    /** @test */
    public function authenticated_admins_can_create_a_new_user(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->make();
        $user = $user->makeVisible('password')->toArray();
        $this->post('/admin/users',$user);
        $this->assertDatabaseHas('users',['username'=> $user['username'] , 'firstname' => $user['firstname']]);

    }
    
     /** @test */
     public function an_admin_can_update_user(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $this->put('/admin/users/'.$user->id,['firstname'=>'new_firstname']);
        $this->assertDatabaseHas('users',['id'=> $user->id , 'firstname' => 'new_firstname']);
    }

    /** @test */
    public function an_admin_can_delete_user(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $this->delete('/admin/users/'.$user->id);
        $this->assertDatabaseMissing('users',['id'=> $user->id]);
    }

    /** @test */
     public function unauthenticated_users_cannot_create_a_new_user(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->post('/admin/users',$user->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_users(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/users')
        ->assertRedirect('/admin/login');
     }

      /** @test */
   public function an_admin_can_see_admin_profil(){
    fwrite(STDOUT, __METHOD__ . "\n");
    $admin = Admin::factory()->create();
    $this->actingAs($admin,'admin');
    $user = User::factory()->create();
    $response = $this->get('/admin/profil');
    $response->assertViewIs('admin.user-profil')  ; 
   }

     /** @test */
    public function an_admin_can_update_profil(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create(['firstname'=>'new_firstname']);
        $this->actingAs($admin,'admin');
        $this->post('/admin/profil',$admin->toArray());
        $this->assertDatabaseHas('admins',['id'=> $admin->id,'firstname'=>$admin->firstname]); 
    }
    /** @test */
    public function an_user_can_see_user_profil(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/user/profil');
        $response->assertViewIs('admin.user-profil')  ; 
    }

     /** @test */
     public function an_user_can_update_profil(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create(['firstname'=>'new_firstname']);
        $this->actingAs($user);
        $this->post('/user/profil',$user->toArray());
        $this->assertDatabaseHas('users',['id'=> $user->id,'firstname'=>$user->firstname]); 
    }

}

