<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutingTable extends Migration
{
    public function up()
    {
        Schema::create('routing', function (Blueprint $table) {
            $table->id();
            $table->string('type_route');
            $table->foreignId('button_click')->nullable()->constrained('detail');
            $table->foreignId('message_response')->constrained('message');
            $table->foreignId('next_response')->nullable()->constrained('choice');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routing');
    }
}
