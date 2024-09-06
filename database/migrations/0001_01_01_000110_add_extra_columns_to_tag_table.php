<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('tags')->nullOnDelete();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
        });

    }

    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            // Dropping the foreign key first before dropping the column
            $table->dropForeign(['parent_id']); // Drops the foreign key constraint
            $table->dropColumn('parent_id'); // Drops the column
    
            // Dropping other columns
            $table->dropColumn('description');
            $table->dropColumn('icon');
        });
    }
};
