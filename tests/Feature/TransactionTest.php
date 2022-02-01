<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Transaction;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TransactionTest extends TestCase
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
   public function an_admin_can_read_all_the_transactions_via_api(){
       fwrite(STDOUT, __METHOD__ . "\n");
       $admin = Admin::factory()->create();
       $this->actingAs($admin,'admin');
       $transaction = Transaction::factory()->create();
       $response = $this->get('/admin/transactions?api=true');
       $response->assertSee($transaction->transaction_id);
   }

    /** @test */
    
    public function an_admin_can_see_transactions_page(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');

        $transaction = Transaction::factory()->create();
        $response = $this->get('/admin/transactions');
        $response->assertViewIs('admin.transactions');
    }

    /** @test */
    public function an_admin_can_search_in_transactions(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        $response = $this->get('/admin/transactions?api=true&search=pay');
        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_a_single_transaction(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        ;
        $transaction  = Transaction::factory()->create();
        $response = $this->get('/admin/transactions/'.$transaction->id);
        $response->assertSee($transaction->name)->assertSee($transaction->id);
    }

  
    /** @test */
    public function an_admin_can_update_transaction(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        ;
        $transaction = Transaction::factory()->create();
        $this->put('/admin/transactions/'.$transaction->id,['amount'=>'1234']);
        $this->assertDatabaseHas('transactions',['id'=> $transaction->id,'amount'=> $transaction->amount]);

    }

    /** @test */
    public function an_admin_can_delete_transaction(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $admin = Admin::factory()->create();
        $this->actingAs($admin,'admin');
        ;
        $transaction = Transaction::factory()->create();
        $this->delete('/admin/transactions/'.$transaction->id);
        $this->assertDatabaseMissing('transactions',['id'=> $transaction->id]);

    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_transaction(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $transaction = Transaction::factory()->create();
        $this->post('/admin/transactions',$transaction->toArray())
        ->assertRedirect('/admin/login');
     }

     /** @test */
     public function unauthenticated_users_cannot_see_transactions(){
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->post('/admin/transactions')
        ->assertRedirect('/admin/login');
     }

   
}
