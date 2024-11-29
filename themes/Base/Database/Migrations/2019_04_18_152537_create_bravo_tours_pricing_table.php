<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Tour\Models\TourPricing;

class CreateBravoToursPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_tour_pricing', function (Blueprint $table) {
            $table->unique(['tour_id', 'person_type']);
            $table->integer('tour_id');
            $table->enum('person_type', TourPricing::getPersonTypes())->default('adult'); //['adult', 'child', 'infant']
            $table->tinyInteger('min_persons')->default(0);
            $table->tinyInteger('max_persons')->default(0);
            $table->smallInteger('price');
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
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
        Schema::dropIfExists('bravo_tour_pricing');
    }
}
