<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); //Creates a primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tells laravel youre referencing the ID column of the user table. Cascade means if user is deleted their posts are
            $table->text('body');
            $table->timestamps(); //created and updated at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
