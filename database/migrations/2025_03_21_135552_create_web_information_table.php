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
        Schema::create('web_information', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('phone')->nullable();

            // Footer Information
            $table->text('column_1')->nullable();
            $table->text('column_2')->nullable();
            $table->text('column_3')->nullable();
            $table->text('column_4')->nullable();

            // Pages
            $table->text('home')->nullable();
            $table->text('product')->nullable();
            $table->text('article')->nullable();
            
            // SEO settings
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();

            // Script
            $table->text('header_script')->nullable();
            $table->text('footer_script')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_information');
    }
};
