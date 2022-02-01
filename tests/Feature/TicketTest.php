<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Ticket;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TicketTest extends TestCase
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
   public function an_admin_can_read_all_the_tickets_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       User::factory()->create();
       $this->actingAs($admin,'admin');
       $ticket = Ticket::factory()->create();
       $response = $this->get('/admin/tickets?api=true');
       $response->assertSee($ticket->name);
   }

    /** @test */
    
    public function an_admin_can_see_tickets_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        User::factory()->create();
        $this->actingAs($admin,'admin');
        $ticket = Ticket::factory()->create();
        $response = $this->get('/admin/tickets');
        $response->assertViewIs('admin.tickets');
    }

    /** @test */
    public function an_admin_can_search_in_tickets(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        User::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/tickets?api=true&search=insta');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_ticket(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        User::factory()->create();
        $this->actingAs($admin,'admin');
        $ticket  = Ticket::factory()->create();
        $response = $this->get('/admin/tickets/'.$ticket->id);
        $response->assertViewIs('admin.tickets-view');
    }

    /** @test */
    public function an_admin_cant_create_a_new_ticket(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        User::factory()->create();
        $this->actingAs($admin,'admin');
        $ticket = Ticket::factory()->make();
        $response = $this->post('/admin/tickets',$ticket->toArray());
        $response->assertStatus(403);
    }

     /** @test */
     public function a_user_create_a_new_ticket(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user);
        $ticket = Ticket::factory()->make();
        $this->post('/user/tickets',$ticket->toArray());
        $this->assertDatabaseHas('tickets',['name'=> $ticket['name']]);

    }

    /** @test */
    public function an_admin_can_update_ticket(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        User::factory()->create();
        $this->actingAs($admin,'admin');
        $ticket = Ticket::factory()->create();
        $this->put('/admin/tickets/'.$ticket->id,['ticket_id'=> $ticket->id,'response_by'=>'admin','content'=>'new_content']);
        $this->assertDatabaseHas('ticket_messages',['ticket_id'=> $ticket->id,'content'=>'new_content']);
    }

    /** @test */
    public function an_admin_can_update_ticket_status(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($admin,'admin');
        $ticket = Ticket::factory()->create();
        $this->put('/admin/tickets/'.$ticket->id,['status'=> 'closed']);
        $this->assertDatabaseHas('tickets',['id'=>$ticket->id,'status'=> 'closed']);
    }
     /** @test */
     public function a_user_cant_update_ticket_status(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $user = User::factory()->create();
        $this->actingAs($user);
        $ticket = Ticket::factory()->create();
        $response = $this->put('/admin/tickets/'.$ticket->id,['status'=> 'closed']);
        $response->assertStatus(302);
    }

    /** @test */
    public function an_admin_can_delete_ticket(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        User::factory()->create();
        $this->actingAs($admin,'admin');
        $ticket = Ticket::factory()->create();
        $this->delete('/admin/tickets/'.$ticket->id);
        $this->assertDatabaseMissing('tickets',['id'=> $ticket->id]);

    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_ticket(){
        fwrite(STDOUT, __METHOD__ . "\n");
        User::factory()->create();
        $ticket = Ticket::factory()->create();
        $this->post('/admin/tickets',$ticket->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_tickets(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/tickets')
        ->assertRedirect('/admin/login');
     }

   
}
