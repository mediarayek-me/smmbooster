<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Announcement;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AnnouncementTest extends TestCase
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
   public function an_admin_can_read_all_the_announcements_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $announcement = Announcement::factory()->create();
       $response = $this->get('/admin/announcements?api=true');
       $response->assertSee($announcement->description);
   }

    /** @test */
    
    public function an_admin_can_see_announcements_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $announcement = Announcement::factory()->create();
        $response = $this->get('/admin/announcements');
        $response->assertViewIs('admin.announcements');
    }

    /** @test */
    public function an_admin_can_search_in_announcements(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/announcements?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_announcement(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $announcement  = Announcement::factory()->create();
        $response = $this->get('/admin/announcements/'.$announcement->id);
        $response->assertSee($announcement->description)->assertSee($announcement->id);
    }

    /** @test */
    public function an_admin_can_create_a_new_announcement(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $announcement = Announcement::factory()->make();
        $this->post('/admin/announcements',$announcement->toArray());
        $this->assertDatabaseHas('announcements',['description'=> $announcement['description']]);

    }

    /** @test */
    public function an_admin_can_update_announcement(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $announcement = Announcement::factory()->create();
        $this->put('/admin/announcements/'.$announcement->id,['description'=>'new_name']);
        $this->assertDatabaseHas('announcements',['id'=> $announcement->id,'description'=>'new_name']);

    }

    /** @test */
    public function an_admin_can_delete_announcement(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $announcement = Announcement::factory()->create();
        $this->delete('/admin/announcements/'.$announcement->id);
        $this->assertDatabaseMissing('announcements',['id'=> $announcement->id]);

    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_announcement(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $announcement = Announcement::factory()->create();
        $this->post('/admin/announcements',$announcement->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_announcements(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/announcements')
        ->assertRedirect('/admin/login');
     }

   
}
