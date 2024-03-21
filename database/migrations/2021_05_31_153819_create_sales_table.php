<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->float('price', 16, 2);
            $table->string('num_order');
            $table->string('model');
            $table->string('machine_detail', 250)->nullable();
            $table->string('desc', 250)->nullable();
            $table->string('adition', 250)->nullable();
            $table->foreignId('user_id')->constrained('users')->default(null);
            $table->foreignId('state_id')->constrained('sell_states');
            $table->foreignId('machine_id')->constrained('machines');
            $table->foreignId('provider_id')->constrained('providers');
            $table->foreignId('client_id')->constrained('clients');
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
        Schema::dropIfExists('sales');
    }
}
