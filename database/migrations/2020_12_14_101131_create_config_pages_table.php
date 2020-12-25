<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_pages', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('view_id');
            $table->string('name_page');
            $table->string('utm_source');
            $table->string('utm_medium');
            $table->string('check')->nullable();
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
        Schema::dropIfExists('config_pages');
    }
}
