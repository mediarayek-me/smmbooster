<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('api_provider_id')->nullable();
            $table->integer('api_provider_service_id')->nullable();
            $table->enum('type',['normal','api'])->default('normal');
            $table->enum('status',['active','deactive']);
            $table->text('name');
            $table->decimal('rate', 10, 4);
            $table->decimal('rate_original', 10, 4)->nullable();
            $table->integer('min');
            $table->integer('max');
            $table->float('percentage_increase')->nullable();;
            $table->text('description')->nullable();
            $table->timestamps();

           $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           $table->foreign('api_provider_id')->references('id')->on('api_providers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
