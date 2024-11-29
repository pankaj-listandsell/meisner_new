<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateRedirectionsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('core_redirections', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->string('status', 50)->nullable()->default('draft');

                $table->text('include_url')->nullable();
                $table->text('exclude_url')->nullable();

                $table->string('schedule_type')->nullable()->default('day');
                $table->string('schedule_amount')->nullable()->default(0);

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
            Schema::dropIfExists('core_redirections');
        }
    }
