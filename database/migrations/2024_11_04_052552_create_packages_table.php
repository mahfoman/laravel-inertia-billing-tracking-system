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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('set null');
            $table->string('name');             // Package name, e.g., "Basic", "Premium"
            $table->decimal('price', 8, 2);     // Price of the package
            $table->string('speed');           // Internet speed (e.g., in Mbps)
            $table->string('description')->nullable(); // Optional description of the package
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
