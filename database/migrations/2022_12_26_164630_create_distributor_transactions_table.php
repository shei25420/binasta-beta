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
        Schema::create('distributor_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("distributor_order_id");
            $table->string("ref");
            $table->unsignedTinyInteger("payment_type")->default(0);
            $table->timestamps();

            $table->foreign("distributor_order_id")->references("id")->on("distributor_orders")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_transactions');
    }
};
