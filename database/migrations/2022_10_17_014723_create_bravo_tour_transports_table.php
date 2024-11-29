<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Tour\Models\TourTransport;

class CreateBravoTourTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_tour_transports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', TourTransport::getTypes());
            $table->text('description')->nullable();
            $table->string('status', 50)->default('draft');
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
        Schema::dropIfExists('bravo_tour_transports');
    }
}
