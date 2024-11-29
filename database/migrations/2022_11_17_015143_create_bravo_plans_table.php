<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_plans', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->integer('duration')->nullable()->default(0);
            $table->string('duration_type', 30)->nullable();
            $table->decimal('annual_price', 12, 2)->nullable();
            $table->integer('max_service')->nullable()->default(0);

            $table->string('status', 30)->nullable();

            $table->bigInteger('role_id')->nullable();
            $table->tinyInteger('is_recommended')->nullable()->default(1);

            $table->softDeletes();
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
        Schema::dropIfExists('bravo_plans');
    }
}
