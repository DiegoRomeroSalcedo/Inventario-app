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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_sale', 10, 2);
            $table->decimal('total_base', 10, 2);
            $table->decimal('total_iva', 10, 2);
            $table->decimal('total_discount', 10, 2)->nullable();
            $table->decimal('received_amount', 10, 2);
            $table->decimal('change_amount', 10, 2);
            $table->string('payment_method');
            
            $table->foreignId('client_id')->constrained('clients')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
