<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Language;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LanguageTest extends TestCase
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
   public function an_admin_can_read_all_the_languages_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $language = Language::factory()->create();
       $response = $this->get('/admin/languages?api=true');
       $response->assertSee($language->name)->assertSee($language->id);
   }

    /** @test */
    
    public function an_admin_can_see_languages_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language = Language::factory()->create();
        $response = $this->get('/admin/languages');
        $response->assertViewIs('admin.languages');
    }

    /** @test */
    public function an_admin_can_search_in_languages(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/languages?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language  = Language::factory()->create();
        $response = $this->get('/admin/languages/'.$language->id);
        $response->assertSee($language->name)->assertSee($language->id);
    }

    /** @test */
    public function an_admin_can_create_a_new_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language = Language::factory()->make();
        $this->post('/admin/languages',$language->toArray());
        $this->assertDatabaseHas('languages',['name'=> $language['name']]);

    }

    /** @test */
    public function an_admin_can_update_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language = Language::factory()->create(['id'=>2]);
        $language_to_update = $language->toArray();
        $language_to_update['name'] = 'new_name';
        $this->put('/admin/languages/'.$language->id,$language_to_update);
        $this->assertDatabaseHas('languages',['id'=> $language->id,'name'=>'new_name']);
    }
       /** @test */
       public function an_admin_can_t_update_the_first_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language = Language::factory()->create(['id'=>1]);
        $this->post('/admin/languages',['id'=>$language->id,'name'=>'new_name']);
        $this->assertDatabaseMissing('languages',['id'=> $language->id,'name'=>'new_name']);

    }

    /** @test */
    public function an_admin_can_delete_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language = Language::factory()->create(['id'=>2]);
        $this->delete('/admin/languages/'.$language->id);
        $this->assertDatabaseMissing('languages',['id'=> $language->id]);
    }

     /** @test */
     public function an_admin_can_t_delete_firstlanguage_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $language = Language::factory()->create(['id'=>1]);
        $this->delete('/admin/languages/'.$language->id);
        $this->assertDatabaseHas('languages',['id'=> $language->id]);
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_language(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $language = Language::factory()->create();
        $this->post('/admin/languages',$language->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_languages(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/languages')
        ->assertRedirect('/admin/login');
     }

   
}
