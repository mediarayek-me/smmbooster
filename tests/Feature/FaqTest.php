<?php

namespace Tests\Feature;

use App\Models\Faq;
use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FaqTest extends TestCase
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
   public function an_admin_can_read_all_the_faqs_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $faq = Faq::factory()->create();
       $response = $this->get('/admin/faqs?api=true');
       $response->assertSee($faq->question);
   }

    /** @test */
    
    public function an_admin_can_see_faqs_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $faq = Faq::factory()->create();
        $response = $this->get('/admin/faqs');
        $response->assertViewIs('admin.faqs');
    }

    /** @test */
    public function an_admin_can_search_in_faqs(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/faqs?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_faq(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $faq  = Faq::factory()->create();
        $response = $this->get('/admin/faqs/'.$faq->id);
        $response->assertSee($faq->question)->assertSee($faq->id);
    }

    /** @test */
    public function an_admin_can_create_a_new_faq(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $faq = Faq::factory()->make();
        $this->post('/admin/faqs',$faq->toArray());
        $this->assertDatabaseHas('faqs',['question'=> $faq['question']]);

    }

    /** @test */
    public function an_admin_can_update_faq(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $faq = Faq::factory()->create();
        $this->put('/admin/faqs/'.$faq->id,['question'=>'new_name']);
        $this->assertDatabaseHas('faqs',['id'=> $faq->id,'question'=>'new_name']);

    }

    /** @test */
    public function an_admin_can_delete_faq(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $faq = Faq::factory()->create();
        $this->delete('/admin/faqs/'.$faq->id);
        $this->assertDatabaseMissing('faqs',['id'=> $faq->id]);

    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_faq(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $faq = Faq::factory()->create();
        $this->post('/admin/faqs',$faq->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_faqs(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/faqs')
        ->assertRedirect('/admin/login');
     }

   
}
