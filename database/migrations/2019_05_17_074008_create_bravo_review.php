<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booking_id')->nullable();
            $table->integer('tour_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->integer('rate_number')->nullable();
            $table->string('author_ip',100)->nullable();
            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->string('lang',10)->nullable();
            $table->softDeletes();

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
        Schema::dropIfExists('bravo_review');
    }
}
