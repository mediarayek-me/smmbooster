<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->from(320);
            $table->string('name');
            $table->integer('user_id');
            $table->string('email');
            $table->enum('type',['order','payment','service','api']);
            $table->enum('status',['pending','answered','closed'])->default('pending');
            $table->string('subject');
            $table->text('message');
            $table->text('file')->nullable();
            $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
