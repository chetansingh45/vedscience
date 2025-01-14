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
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feed_cat_id');
            $table->foreign('feed_cat_id')
                  ->references('id')
                  ->on('feed_categories'); 
            $table->longText('title');
            $table->longText('slug')->unique();;
            $table->longText('description');
            $table->tinyInteger('status')->default(1)->comment('0: Inactive, 1: Active');
            $table->json('tags')->nullable();
            $table->string('main_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
