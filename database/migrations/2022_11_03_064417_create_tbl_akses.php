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
        Schema::create('tbl_akses', function (Blueprint $table) {
            $table->bigIncrements('akses_id');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('submenu_id')->nullable();
            $table->unsignedBigInteger('othermenu_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('akses_type');
            $table->foreign('menu_id')->references('menu_id')->on('tbl_menu')->nullOnDelete();
            $table->foreign('submenu_id')->references('submenu_id')->on('tbl_submenu')->nullOnDelete();
            // $table->foreign('othermenu_id')->references('othermenu_id')->on('tbl_role')->nullOnDelete();
            $table->foreign('role_id')->references('role_id')->on('tbl_role')->nullOnDelete();
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
        Schema::dropIfExists('tbl_akses');
    }
};
