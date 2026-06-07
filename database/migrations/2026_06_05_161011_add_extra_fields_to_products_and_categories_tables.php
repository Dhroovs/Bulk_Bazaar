<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->nullable()->after('name');
            $table->string('brand')->nullable()->after('sku');
            $table->decimal('discount_price', 10, 2)->nullable()->after('price');
            $table->string('status')->default('active')->after('stock');
            $table->string('tags')->nullable()->after('status');
            $table->text('specifications')->nullable()->after('tags');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('name');
            $table->text('description')->nullable()->after('image');
            $table->string('status')->default('active')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sku', 'brand', 'discount_price', 'status', 'tags', 'specifications']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['image', 'description', 'status']);
        });
    }
};
