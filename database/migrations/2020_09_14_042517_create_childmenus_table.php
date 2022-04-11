<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childmenus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->longText('detail')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active','inactive'])->default('inactive');
            $table->unsignedBigInteger('submenu_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
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
        Schema::dropIfExists('childmenus');
    }
}
