<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_appreance', function (Blueprint $table) {
            $table->bigIncrements('appreance_id');
            $table->unsignedBigInteger('user_id')->nullable();            
            $table->string('appreance_layout')->nullable();
            $table->string('appreance_theme')->nullable();
            $table->string('appreance_menu')->nullable();
            $table->string('appreance_header')->nullable();
            $table->string('appreance_sidestyle')->nullable();
            $table->foreign('user_id')->references('user_id')->on('tbl_user')->nullOnDelete();
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
        Schema::dropIfExists('tbl_appreance');
    }
};
