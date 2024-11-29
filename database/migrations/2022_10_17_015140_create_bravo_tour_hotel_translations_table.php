<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoTourHotelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_tour_hotel_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('origin_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name', 255)->nullable();
            $table->string('phone_no', 50)->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bravo_tour_hotel_translations');
    }
}
