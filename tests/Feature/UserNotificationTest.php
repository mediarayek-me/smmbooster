<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\UserNotification;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserNotificationTest extends TestCase
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
   public function an_admin_can_read_all_the_user_notifications_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $user = User::factory()->create();
       $userNotification = UserNotification::factory()->create();
       $response = $this->get('/admin/user-notifications?api=true');
       $response->assertSee($userNotification->id);
   }

    /** @test */
    public function an_admin_can_see_user_notifications_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $userNotification = UserNotification::factory()->create();
        $response = $this->get('/admin/user-notifications');
        $response->assertViewIs('admin.user-notifications');
    }

     /** @test */
     public function an_user_can_see_user_notifications_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user);
        $userNotification = UserNotification::factory()->create();
        $response = $this->get('/user/user-notifications');
        $response->assertViewIs('admin.user-notifications');
    }

    /** @test */
    public function an_admin_can_search_in_user_notifications(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/user-notifications?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_user_notifications(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $userNotification  = UserNotification::factory()->create();
        $response = $this->get('/admin/user-notifications/'.$userNotification->id);
        $response->assertSee($userNotification->content)->assertSee($userNotification->id);
    }

    /** @test */
    public function an_admin_can_create_a_new_user_notifications(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $userNotification = UserNotification::factory()->make();
        $this->post('/admin/user-notifications',$userNotification->toArray());
        $this->assertDatabaseHas('user_notifications',['content'=> $userNotification['content']]);

    }


    /** @test */
    public function an_admin_can_delete_user_notifications(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $user = User::factory()->create();
        $userNotification = UserNotification::factory()->create();
        $this->delete('/admin/user-notifications/'.$userNotification->id);
        $this->assertDatabaseMissing('user_notifications',['id'=> $userNotification->id]);

    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_user_notifications(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $userNotification = UserNotification::factory()->create();
        $this->post('/admin/user-notifications',$userNotification->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_user_notifications(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/user-notifications')
        ->assertRedirect('/admin/login');
     }

   
}
