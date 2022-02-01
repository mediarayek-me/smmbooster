<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingTest extends TestCase
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
   public function an_admin_can_see_general_settings_page(){
    fwrite(STDOUT, __METHOD__ . "\n");
    $admin = Admin::factory()->create();
    $this->actingAs($admin,'admin');
    $response = $this->get('/admin/settings/general');
    $response->assertViewIs('admin.settings.general');
    $response->assertStatus(200);
} 

    /** @test */
   public function an_admin_can_see_apparence_settings_page(){
    fwrite(STDOUT, __METHOD__ . "\n");
    $admin = Admin::factory()->create();
    $this->actingAs($admin,'admin');
    $response = $this->get('/admin/settings/apparence');
    $response->assertViewIs('admin.settings.apparence');
    $response->assertStatus(200);
}   
 /** @test */
   public function an_admin_can_see_seo_settings_page(){
    fwrite(STDOUT, __METHOD__ . "\n");
    $admin = Admin::factory()->create();
    $this->actingAs($admin,'admin');
    $response = $this->get('/admin/settings/seo');
    $response->assertViewIs('admin.settings.seo');
    $response->assertStatus(200);
} 
/** @test */
   public function an_admin_can_see_policy_settings_page(){
    fwrite(STDOUT, __METHOD__ . "\n");
    $admin = Admin::factory()->create();
    $this->actingAs($admin,'admin');
    $response = $this->get('/admin/settings/policy');
    $response->assertViewIs('admin.settings.policy');
    $response->assertStatus(200);
}
/** @test */
   public function an_admin_can_see_emails_settings_page(){
    fwrite(STDOUT, __METHOD__ . "\n");
    $admin = Admin::factory()->create();
    $this->actingAs($admin,'admin');
    $response = $this->get('/admin/settings/emails');
    $response->assertViewIs('admin.settings.emails');
    $response->assertStatus(200);
}

    /** @test */
    public function an_admin_can_create_a_new_setting(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $setting = ['new_name'=>'new_value','type'=>'general'];
        $response = $this->post('/admin/settings',$setting);
        $this->assertDatabaseHas('settings',['value'=> 'new_value']);
        // $response->assertStatus(200);

    }

    /** @test */
    public function an_admin_can_update_setting_if_exist(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $setting = Setting::factory()->create();
        $response = $this->post('/admin/settings',[$setting->name => 'new_value']);
        $this->assertDatabaseHas('settings',['id'=> $setting->id,'value'=>'new_value']);

    }

    /** @test */
    public function an_admin_can_delete_setting(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $setting = Setting::factory()->create();
        $response = $this->delete('/admin/settings/'.$setting->id);
        $this->assertDatabaseMissing('settings',['id'=> $setting->id]);
        $response->assertStatus(200);
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_setting(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $setting = ['new_name'=>'new_value','type'=>'general'];
        $response = $this->post('/admin/settings',$setting)
        ->assertRedirect('/admin/login');
        $response->assertStatus(302);
     }

     /** @test */
     public function unauthenticated_users_cannot_see_settings(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $response = $this->post('/admin/settings')
        ->assertRedirect('/admin/login');
        $response->assertStatus(302);
     }

   
}
