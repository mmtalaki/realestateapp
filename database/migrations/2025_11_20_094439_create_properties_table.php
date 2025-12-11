<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->string("address");
            $table->string("city");
            $table->string("county");
            $table->double("price");
            $table->double("bedrooms");
            $table->double("bathrooms");
            $table->double("sq_meters");
            $table->string("offer_type");
            $table->string("property_type");
            $table->string("status");
            $table->string("year_built");
            $table->string("latitude");
            $table->string("longitude");

            $table->unsignedBigInteger('user_id');

            $table->foreign("user_id")->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
