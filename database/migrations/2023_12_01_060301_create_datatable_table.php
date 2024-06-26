<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatatableTable extends Migration
{
    public function up()
    {
        Schema::create('datatable', function (Blueprint $table) {
            $table->id();
             $table->string('name')->nullable();
             $table->string('email')->nullable();
             $table->string('number')->nullable();
             $table->string('gender');
             $table->string('dob');
             $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('datatable');
    }
}
