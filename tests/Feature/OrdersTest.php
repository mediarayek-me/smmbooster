<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Service;
use App\Models\Category;
use App\Models\ApiProvider;
use App\Models\UserNotification;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrdersTest extends TestCase
{
   use DatabaseMigrations;

   public function setUp():void
   {
      parent::setUp();

      // seed database
      $seeder = new DatabaseSeeder();
      $seeder->run();
   }

  
     /** @test */
    public function an_admin_can_read_all_the_orders_via_api(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $order = Order::factory()->create();
        $response = $this->get('/admin/orders?api=true');
        $response->assertSee($order->id);
    }

     /** @test */
     public function a_user_can_make_order(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $funds = $user->funds;
        $this->actingAs($user);
        $order = Order::factory()->make();
        // $this->assertTrue(UserNotification::count() === 0 );
        $response = $this->post('/user/orders',$order->toArray());
        $response->assertStatus(200);
        $this->assertDatabaseHas('orders',['link'=> $order['link']]);
        $this->assertTrue($user->funds === $funds - $order['total']);
        // $this->assertTrue(UserNotification::count() === 1);
    }

 
     /** @test */
     public function an_admin_can_see_orders_page(){
         fwrite(STDOUT, __METHOD__ . "\n");
         $admin = Admin::factory()->create();
         $this->actingAs($admin,'admin');
         $response = $this->get('/admin/orders');
         $response->assertViewIs('admin.orders');
     }

      /** @test */
      public function an_user_cant_see_orders_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/admin/orders');
        $response->assertStatus(302);
    }
    
   
}
