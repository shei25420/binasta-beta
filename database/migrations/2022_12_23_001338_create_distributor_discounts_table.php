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
        Schema::create('distributor_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("distributor_package_id");
            $table->unsignedInteger("percentage");
            $table->boolean('active')->default(true);
            $table->string('start_date');
            $table->string('end_date');
            $table->timestamps();

            $table->foreign("distributor_package_id")->references("id")->on("distributor_packages");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_discounts');
    }
};
