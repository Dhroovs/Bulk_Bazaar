<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active'); // active, hidden, deleted
            $table->boolean('is_verified_purchase')->default(false);
            $table->timestamps();

            // Prevent duplicate reviews per user per product
            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
