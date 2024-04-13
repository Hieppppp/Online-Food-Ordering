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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name');
            $table->longText('product_detail');
            $table->text('product_image');
            $table->integer('product_status');
            $table->datetime('added_on');
            $table->bigInteger('category_id')->unsigned();
            $table->string('full')->nullable();
            $table->float('full_price',10,2)->nullable();
            $table->string('half')->nullable();
            $table->float('half_price',10,2)->nullable();
            $table->timestamps();

            // Thêm ràng buộc ngoại
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
