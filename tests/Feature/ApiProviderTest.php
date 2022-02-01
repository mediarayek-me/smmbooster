<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Service;
use App\Models\ApiProvider;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiProviderTest extends TestCase
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
   public function an_admin_can_read_all_the_api_providers_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $api_providers = ApiProvider::factory()->create();
       $response = $this->get('/admin/api-providers?api=true');
       $response->assertSee($api_providers->name);
   }

    /** @test */
    
    public function an_admin_can_see_api_providers_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_providers = ApiProvider::factory()->create();
        $response = $this->get('/admin/api-providers');
        $response->assertViewIs('admin.api_providers');
    }

    /** @test */
    public function an_admin_can_search_in_api_providers(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/api-providers?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_api_providers(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_providers  = ApiProvider::factory()->create();
        $response = $this->get('/admin/api-providers/'.$api_providers->id);
        $response->assertSee($api_providers->name)->assertSee($api_providers->id);
    }

    /** @test */
    public function authenticated_admins_can_create_a_new_api_providers_and_add_api_services(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_providers = ApiProvider::factory()->make();
        $response = $this->post('/admin/api-providers',$api_providers->toArray());
        $api_provider = $response->getData();
        $services_count = Service::where('api_provider_id',$api_provider->id)->get()->count();
        $this->assertDatabaseHas('api_providers',['id'=> $api_provider->id,'name'=> $api_provider->name]);
        $this->assertTrue($services_count > 0);
        $this->assertTrue($api_provider->services_count  === $services_count);
    }
    
     /** @test */
     public function an_admin_can_update_api_providers_and_update_api_services(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_providers = ApiProvider::factory()->create();
        $response = $this->put('/admin/api-providers/'.$api_providers->id,['name'=>'new_name']);
        $api_provider = $response->getData();
        $services_count = Service::where('api_provider_id',$api_provider->id)->get()->count();
        $this->assertDatabaseHas('api_providers',['id'=> $api_provider->id,'name'=>'new_name']);
        $this->assertTrue($services_count > 0);
        $this->assertTrue($api_provider->services_count  === $services_count);

    }

    /** @test */
    public function an_admin_can_delete_api_providers_and_delete_api_services(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_providers = ApiProvider::factory()->make();
        $response = $this->post('/admin/api-providers',$api_providers->toArray());
        $api_provider = $response->getData();
        $this->assertDatabaseHas('api_providers',['id'=> $api_provider->id,'name'=> $api_provider->name]);
        $services_count = Service::where('api_provider_id',$api_provider->id)->get()->count();
        $this->assertTrue($services_count > 0);
        $this->delete('/admin/api-providers/'.$api_provider->id);
        $this->assertDatabaseMissing('api_providers',['id'=> $api_provider->id]);
        $services_count = Service::where('api_provider_id',$api_provider->id)->get()->count();
        $this->assertTrue($services_count === 0);
    }

     /** @test */
     public function unauthenticated_users_cannot_create_a_new_api_providers(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $api_providers = ApiProvider::factory()->create();
        $this->post('/admin/api-providers',$api_providers->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_api_providers(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/api-providers')
        ->assertRedirect('/admin/login');
     }

       /** @test */
    public function an_admin_can_check_balance_via_api(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_provider = ApiProvider::factory()->make();
        $data = ['url'=>$api_provider->url,'key'=>$api_provider->api_key,'action'=>'balance'];
        $response = $this->post('/admin/api-providers/api',$data);
        $response->assertSee('balance');
    }
    /** @test */
    public function an_admin_can_get_services_via_api(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $api_provider = ApiProvider::factory()->make();
        $data = ['url'=>$api_provider->url,'key'=>$api_provider->api_key,'action'=>'services'];
        $services = $this->post('/admin/api-providers/api',$data);
        $this->assertTrue(!empty($services));
    }

   
}
