<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('subtotal', 15, 2)->nullable()->change();
            $table->decimal('total_base', 15, 2)->nullable()->change();
            $table->decimal('total_iva', 15, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('subtotal', 15, 2)->nullable(false)->change();
            $table->decimal('total_base', 15, 2)->nullable(false)->change();
            $table->decimal('total_iva', 15, 2)->nullable(false)->change();
        });
    }
};
