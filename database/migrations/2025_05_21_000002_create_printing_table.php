<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('print_token')->nullable();
            $table->unsignedBigInteger('print_userid')->nullable();
            $table->timestamp('print_created_date')->useCurrent();
            $table->dateTime('print_date')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printing');
    }
};
