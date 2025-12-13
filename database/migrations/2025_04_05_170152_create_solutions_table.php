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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('solution_type')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('img_width')->nullable();
            $table->string('img_height')->nullable();
            $table->string('gallery')->nullable();
            $table->json('tags')->nullable();
            $table->json('file')->nullable();
            $table->text('content')->nullable();
            $table->text('desc')->nullable();
            $table->boolean('is_published')->default(1);
            $table->timestamps();
        });


        Schema::create('solutions_contents', function (Blueprint $table) {
            $table->id();
            $table->string('solution_id');
            $table->string('content')->nullable();
            $table->string('img_width')->nullable();
            $table->string('img_height')->nullable();
            $table->integer('cont_orderby')->nullable();
            $table->text('desc')->nullable();
            $table->boolean('is_published')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
