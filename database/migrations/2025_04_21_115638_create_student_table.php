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
        Schema::create('student', function (Blueprint $table) {
            $table->id('nisn');
            $table->string('nama', 250);
            $table->string('alamat', 250);
            $table->string('asal_sekolah',250);
            $table->date('tanggal_lahir', 250);
            $table->string('jenis_kelamin', 250);
            $table->string('email', 250);
            $table->string('thumbnail', 250);
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('student');
    }
};
