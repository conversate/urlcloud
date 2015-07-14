<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function(Blueprint $table) {
            $table->increments('id');
            $table->string('hash', 128)->index();
            $table->string('file', 140)->index();
            $table->string('uri', 25)->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->json('metadata')->nullable();
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
        Schema::drop('links');
    }
}
