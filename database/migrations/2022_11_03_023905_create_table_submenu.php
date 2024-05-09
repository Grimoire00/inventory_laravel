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
        Schema::create('tbl_submenu', function (Blueprint $table) {
            $table->bigIncrements('submenu_id');            
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->string('submenu_judul');
            $table->string('submenu_slug');
            $table->string('submenu_redirect');
            $table->string('submenu_sort');
            $table->foreign('menu_id')->references('menu_id')->on('tbl_menu')->nullOnDelete();
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
        Schema::dropIfExists('tbl_submenu');
    }
};
