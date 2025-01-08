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
        Schema::create('share_ranges', function (Blueprint $table) {
            $table->id();
            $table->string('user_type'); // User role (e.g., Promoter, Member)
            $table->integer('min_shares'); // Minimum number of shares
            $table->integer('max_shares'); // Maximum number of shares
            $table->boolean('active')->default(true); // Active status of the share range (default: active)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_ranges');
    }
};
