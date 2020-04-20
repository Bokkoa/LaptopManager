<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignations', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number');
            $table->string('employee');
            $table->string('uid')->nullable();

            $table->unsignedBigInteger('laptop_id');
            $table->foreign('laptop_id')->references('id')->on('laptops');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('asignations');
    }
}
