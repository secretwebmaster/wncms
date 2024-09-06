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
        Schema::create('contact_form_options', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // field name 
            $table->string('type'); // text | textarea | select
            $table->json('display_name')->nullable();
            $table->json('placeholder')->nullable();
            $table->json('default_value')->nullable();
            $table->json('options')->nullable(); // comma separated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_form_options');
    }
};
