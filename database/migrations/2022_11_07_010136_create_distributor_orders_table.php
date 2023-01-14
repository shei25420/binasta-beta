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
        Schema::create('distributor_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distributor_id');
            $table->unsignedBigInteger('distributor_address_id')->nullable();

            $table->string('ref')->unique();
            $table->string('location')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedBigInteger('amount');
            $table->timestamps();

            $table->foreign('distributor_id')->references('id')->on('distributors')->onDelete('cascade');
            $table->foreign('distributor_address_id')->references('id')->on('distributor_addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_orders');
    }
};
