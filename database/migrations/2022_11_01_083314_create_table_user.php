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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('user_nmlengkap');
            $table->string('user_nama');
            $table->string('user_email');
            $table->string('user_foto');
            $table->string('user_password');
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
        Schema::dropIfExists('table_user');
    }
};
