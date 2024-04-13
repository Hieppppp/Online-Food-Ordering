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
        Schema::create('blog_details', function (Blueprint $table) {
            $table->bigIncrements('blogdetail_id');
            $table->bigInteger('blog_id')->unsigned();
            $table->string('blogdetail_name');
            $table->string('blogdetail_content');
            $table->longText('blogdetail_detail');
            $table->text('blogdetail_image');
            $table->integer('blogdetail_status');
            $table->datetime('added_on');
            $table->timestamps();

            $table->foreign('blog_id')->references('blog_id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_details');
    }
};
