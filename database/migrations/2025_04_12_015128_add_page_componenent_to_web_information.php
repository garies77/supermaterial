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
        Schema::table('web_information', function (Blueprint $table) {
            $table->text('home_header_component')->nullable();
            $table->text('home_footer_component')->nullable();
            $table->text('product_header_component')->nullable();
            $table->text('product_footer_component')->nullable();
            $table->text('article_header_component')->nullable();
            $table->text('article_footer_component')->nullable();
            $table->text('product_detail_header_component')->nullable();
            $table->text('product_detail_footer_component')->nullable();
            $table->text('article_detail_header_component')->nullable();
            $table->text('article_detail_footer_component')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_information', function (Blueprint $table) {
            $table->dropColumn('home_header_component');
            $table->dropColumn('home_footer_component');
            $table->dropColumn('product_header_component');
            $table->dropColumn('product_footer_component');
            $table->dropColumn('article_header_component');
            $table->dropColumn('article_footer_component');
            $table->dropColumn('product_detail_header_component');
            $table->dropColumn('product_detail_footer_component');
            $table->dropColumn('article_detail_header_component');
            $table->dropColumn('article_detail_footer_component');
        });
    }
};
