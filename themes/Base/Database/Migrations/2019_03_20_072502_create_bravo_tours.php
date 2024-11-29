<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBravoTours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->integer('image_id')->nullable();
            $table->text('short_desc')->nullable();
            $table->smallInteger('max_person')->default(100);
            $table->text('pickup_time')->nullable();
            $table->text('arrival_time')->nullable();
            $table->time('order_time')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('transport_ids')->default('[]');

            /*$table->tinyInteger('is_featured')->nullable();*/
            $table->integer('banner_image_id')->nullable();
            $table->string('gallery', 255)->nullable();
            $table->string('yt_link', 255)->nullable();
            $table->text('surrounding')->nullable();

            //Extra Info
            $table->text('itinerary')->nullable();
            $table->text('faqs')->nullable();
            $table->boolean('is_vip')->default(0);
            $table->string('status',50)->nullable();
            $table->dateTime('publish_date')->nullable();

            //Languages
            $table->bigInteger('origin_id')->nullable();
            $table->string('lang',10)->nullable();

            $table->tinyInteger('default_state')->default(1)->nullable();
            $table->decimal('review_score',2,1)->nullable();

            $table->string('color', 10)->default('#000000');

            $table->smallInteger('order_no')->default(1);
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bravo_tour_term', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('term_id')->nullable();
            $table->integer('tour_id')->nullable();

            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
        });

        Schema::create('bravo_tour_translations', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('origin_id')->nullable();
            $table->string('locale',10)->nullable();

            //Tour info
            $table->string('title', 255)->nullable();
            $table->string('slug',255)->charset('utf8')->index();
            $table->text('content')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('pickup_time')->nullable();
            $table->text('arrival_time')->nullable();
            $table->text('faqs')->nullable();
            $table->text('itinerary')->nullable();
            $table->text('surrounding')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->unique(['origin_id', 'locale']);
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
        Schema::dropIfExists('bravo_tours');
        Schema::dropIfExists('bravo_tour_term');
    }
}
