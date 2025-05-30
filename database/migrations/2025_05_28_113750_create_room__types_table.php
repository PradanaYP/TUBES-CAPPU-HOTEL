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
        Schema::create('room__types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->string('description');
            $table->decimal('price_per_night', 10, 2);

            $table->string('overview_image')->nullable(); 
            $table->string('gallery_image_1')->nullable(); 
            $table->string('gallery_image_2')->nullable(); 
            $table->string('gallery_image_3')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room__types');
    }
};
