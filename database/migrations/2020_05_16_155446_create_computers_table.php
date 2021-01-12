<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('friendly_name');
            $table->string('processor');
            $table->string('graphics');
            $table->integer('ram');
            $table->integer('storage');
            $table->enum('os', ['Windows', 'Linux', 'MacOS', 'BSD', 'Other'])->nullable();
            $table->boolean('inspection')->default(0);
            $table->dateTime('next_inspection')->nullable();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computers');
    }
}
