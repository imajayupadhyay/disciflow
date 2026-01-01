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
        Schema::create('budget_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('name');
            $table->enum('alert_type', ['budget_exceeded', 'category_spending', 'daily_spending', 'transaction_threshold']);
            $table->foreignId('budget_id')->nullable()->constrained('budgets')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('budget_categories')->onDelete('cascade');
            $table->enum('condition_type', ['percentage', 'amount'])->default('percentage');
            $table->decimal('threshold_value', 10, 2);
            $table->enum('condition_operator', ['exceeds', 'equals'])->default('exceeds');
            $table->enum('frequency', ['once', 'daily', 'weekly', 'monthly'])->default('once');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_triggered')->default(false);
            $table->timestamp('last_triggered_at')->nullable();
            $table->boolean('send_email')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_alerts');
    }
};
