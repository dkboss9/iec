<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('detail')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->string('flag')->default('0');
            $table->string('link')->nullable();
            $table->string('video')->nullable();
            $table->string('image');
            $table->enum('status', ['active','inactive'])->default('inactive');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('submenu_id')->nullable();
            $table->unsignedBigInteger('childmenu_id')->nullable();
            $table->foreign('childmenu_id')->references('id')->on('childmenus')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('submenu_id')->references('id')->on('submenus')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('videos');
    }
}
