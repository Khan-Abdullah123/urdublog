<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_password')->nullable();
            $table->timestamps();
        });

        Schema::create('visitor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->dateTime('datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('blog_id');
            $table->string('blog_title')->nullable();
            $table->text('blog_short_desc')->nullable();
            $table->text('blog_long_desc')->nullable();
            $table->string('blog_image')->nullable();
            $table->timestamps();
        });

        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('gallery_id');
            $table->string('gallery_image')->nullable();
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'user_id' => 1,
            'user_name' => 'admin',
            'user_email' => 'admin@gmail.com',
            'user_password' => '$2y$10$tvLTi0vALugSToUy6LGNh.iiVhro5hvLq78E125oTiLoAZovsUWT2',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('visitor');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('gallery');
        Schema::dropIfExists('contacts');
    }
}
