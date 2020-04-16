<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_socials', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->integer('user_id');
            $table->string('social_media');
            $table->string('username');
            $table->timestamps();
        });

        Schema::create('media_socials', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_socials');
    }
}
