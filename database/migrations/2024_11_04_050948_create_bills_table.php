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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('set null');
            $table->foreignId('ip_address_id')->constrained()->onDelete('set null');
            $table->string('billing_month', 7);  // Store the month for which the bill is generated
            $table->string('package_name'); //name of the package at the time of billing
            $table->decimal('amount', 8, 2); // Bill amount for package at the time of billing
            $table->integer('speed'); // Internet speed for package at the time of billing
            $table->enum('status', ['paid', 'due'])->default('due'); // Payment status
            $table->date('paid_on')->nullable(); // Date when the bill was paid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
