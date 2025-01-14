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
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->id();
//            $table->string('country', 10)->nullable();
//            $table->string('postal_code', 20)->nullable();
//            $table->string('city', 100)->nullable();
//            $table->string('province', 100)->nullable();
//            $table->string('province_abbr', 100)->nullable();
//            $table->double('latitude')->nullable();
//            $table->double('longitude')->nullable();
//            $table->integer('time_zone')->nullable();


            $table->char('country_code', 2); // ISO country code (2 characters)
            $table->string('postal_code', 20); // Postal code
            $table->string('place_name', 180); // Place name
            $table->string('admin_name1', 100)->nullable(); // 1st order subdivision (state)
            $table->string('admin_code1', 20)->nullable(); // 1st order subdivision code (state)
            $table->string('admin_name2', 100)->nullable(); // 2nd order subdivision (county/province)
            $table->string('admin_code2', 20)->nullable(); // 2nd order subdivision code (county/province)
            $table->string('admin_name3', 100)->nullable(); // 3rd order subdivision (community)
            $table->string('admin_code3', 20)->nullable(); // 3rd order subdivision code (community)
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude (WGS84)
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude (WGS84)
            $table->tinyInteger('accuracy')->nullable()->comment('1=estimated, 4=geonameid, 6=centroid of addresses or shape'); // Accuracy



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postal_codes');
    }
};
