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
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('gmap');
            $table->string('pn1');
            $table->string('pn2');
            $table->string('email');
            $table->string('fb');
            $table->string('insta');
            $table->string('tw');
            $table->longText('iframe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
