<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['Standard', 'COMPIS Basic', 'COMPIS Silver', 'COMPIS Titanium', 'COMPIS Gold']);
            $table->boolean('diagnosis')->default(0);
            $table->enum('diagnosis_interval', [0, 1, 3])->default(0);
            $table->boolean('parts')->default(0);
            $table->boolean('upgrades')->default(0);
            $table->boolean('computers')->default(0);
            $table->boolean('support')->default(0);
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
