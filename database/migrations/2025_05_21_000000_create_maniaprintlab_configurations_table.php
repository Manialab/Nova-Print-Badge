<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maniaprintlab_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Profile name');
            $table->string('font_family')->nullable()->comment('Uploaded font file path');
            $table->string('background_image')->nullable()->comment('Uploaded background image path');
            $table->boolean('show_background')->default(true)->comment('Show or hide background by default');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maniaprintlab_configurations');
    }
};
