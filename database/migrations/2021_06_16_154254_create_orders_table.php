<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->from(520);
            $table->integer('user_id');
            $table->integer('service_id');
            $table->integer('order_api_id')->nullable();
            $table->string('api_provider_error')->nullable();
            $table->integer('quantity');
            $table->string('link');
            $table->decimal('total', 10, 4);
            $table->text('details');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending','processing','in progress','completed','partial','refunded','awaiting','error'])->default('pending');
            $table->timestamps();

           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           // $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
