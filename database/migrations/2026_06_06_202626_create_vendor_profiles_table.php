<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vendor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('store_name');
            $table->text('store_description')->nullable();
            $table->string('store_logo')->nullable();
            $table->string('store_banner')->nullable();
            $table->decimal('commission_rate', 5, 2)->default(10.00);
            $table->decimal('earnings', 15, 2)->default(0.00);
            $table->string('status')->default('pending'); // pending, approved, rejected, suspended
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor_profiles');
    }
};
