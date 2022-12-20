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
        Schema::create('distributor_order_distributor_package', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distributor_order_id');
            $table->unsignedBigInteger('distributor_package_id');
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->foreign('distributor_order_id', 'd_o_p_index')->references('id')->on('distributor_orders')->onDelete('cascade');
            $table->foreign('distributor_package_id', 'd_p_o_index')->references('id')->on('distributor_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_order_distributor_package');
    }
};
