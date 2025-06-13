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
        //
        // Fee Structures
        

        // Student Fees
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('fee_structure_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('status', ['pending', 'partial', 'paid'])->default('pending');
            $table->date('due_date');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_fee_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->string('payment_method'); // e.g., cash, bank transfer, online
            $table->string('transaction_id')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('received_by')->constrained('users');
            $table->timestamps();
        });

        // Expenses
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
