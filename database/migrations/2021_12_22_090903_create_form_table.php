<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTable extends Migration
{
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('kls');
            $table->string('jurusan');
            $table->text('masukan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form');
    }
}
