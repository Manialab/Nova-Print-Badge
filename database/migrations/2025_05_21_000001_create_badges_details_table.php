<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('badges_details', function (Blueprint $table) {
            $table->bigIncrements('bd_id');
            $table->integer('bd_type_id');
            $table->integer('bd_width');
            $table->integer('bd_height');
            $table->integer('bd_name_show');
            $table->integer('bd_name_position');
            $table->integer('bd_country_show');
            $table->integer('bd_country_position');
            $table->integer('bd_company_show');
            $table->integer('bd_company_position');
            $table->integer('bd_position_show');
            $table->integer('bd_position_position');
            $table->integer('bd_type_show');
            $table->integer('bd_type_position');
            $table->integer('bd_code_show');
            $table->integer('bd_code_position');
            $table->integer('bd_name_positionx');
            $table->integer('bd_country_positionx');
            $table->integer('bd_company_positionx');
            $table->integer('bd_position_positionx');
            $table->integer('bd_type_positionx');
            $table->integer('bd_code_positionx');
            $table->integer('bd_profile_show');
            $table->integer('bd_profile_position');
            $table->integer('bd_profile_positionx');
            $table->integer('bd_profile_width');
            $table->timestamp('bd_created_date')->useCurrent();
            $table->integer('s_font')->default(20);
            $table->integer('bd_rotatename')->default(0);
            $table->integer('db_rotatetype')->default(0);
            $table->integer('db_rotatecompany')->default(0);
            $table->integer('db_rotatecountry')->default(0);
            $table->integer('db_rotatposition')->default(0);
            $table->integer('companyfont')->default(20);
            $table->integer('positionfont')->default(20);
            $table->integer('typefont')->default(18);
            $table->integer('tick_type')->default(1);
            $table->integer('bd_qr_width')->default(100);
            $table->integer('bd_margin')->default(20);
            $table->string('db_color', 20)->default('#000000');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badges_details');
    }
};
