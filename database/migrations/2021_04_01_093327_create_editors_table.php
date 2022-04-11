<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editors', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_verified')->default(false);
            $table->boolean('blog')->default(false);
            $table->boolean('gallery')->default(false);
            $table->string('citizenship');
            $table->string('phone')->nullable();
            $table->string('other_id')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('address')->nullable();
            $table->longText('detail')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->string('category')->nullable();
            $table->string('menu')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            
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
        Schema::dropIfExists('editors');
    }
}
