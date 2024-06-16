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
        Schema::create('transfer_of_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_type');
            $table->string('current_municipality');
            $table->string('requested_municipality');
            $table->foreignId('userprofile_id')->constrained('userprofiles')->cascadeOnDelete();
            $table->string('municipality_admin');
            $table->string('transfer_admin')->default('pending');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_of_requests');
    }
};
