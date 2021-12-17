<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('type_message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('message');
    }
}
