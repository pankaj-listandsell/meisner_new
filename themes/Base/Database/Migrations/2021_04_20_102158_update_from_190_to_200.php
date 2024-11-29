f<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Location\Models\LocationCategory;
use Modules\Location\Models\LocationCategoryTranslation;

class UpdateFrom190To200 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable((new LocationCategory())->getTable())) {
            Schema::create((new LocationCategory())->getTable(), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 255)->nullable();
                $table->string('icon_class', 255)->nullable();
                $table->text('content')->nullable();
                $table->string('slug', 255)->nullable();
                $table->string('status', 50)->nullable();
                $table->nestedSet();

                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->softDeletes();

                //Languages
                $table->bigInteger('origin_id')->nullable();
                $table->string('lang', 10)->nullable();

                $table->timestamps();
            });
        }

        if (!Schema::hasTable((new LocationCategoryTranslation())->getTable())) {
            Schema::create((new LocationCategoryTranslation())->getTable(), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('origin_id')->nullable();
                $table->string('locale', 10)->nullable();

                $table->string('name', 255)->nullable();
                $table->text('content')->nullable();

                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->unique(['origin_id', 'locale']);
                $table->timestamps();
            });
        }

        Schema::table('bravo_attrs', function (Blueprint $table) {
            if (!Schema::hasColumn('bravo_attrs', 'hide_in_filter_search')) {
                $table->tinyInteger('hide_in_filter_search')->nullable();
            }
        });
        Schema::table('core_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('core_pages', 'header_style')) {
                $table->string('header_style',255)->nullable();
            }
            if (!Schema::hasColumn('core_pages', 'custom_logo')) {
                $table->integer('custom_logo')->nullable();
            }
        });

        Schema::table('bravo_attrs', function (Blueprint $table) {
            if (!Schema::hasColumn('bravo_attrs', 'position')) {
                $table->smallInteger('position')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
