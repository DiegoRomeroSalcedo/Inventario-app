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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('cost', 10, 2);
            $table->decimal('retencion', 10, 2)->default(0);
            $table->decimal('IVA', 10, 2)->default(19);
            $table->decimal('cost_with_taxes', 10, 2);
            $table->decimal('utility', 10, 2)->default(0);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->date('expiration_date')->nullable();
            $table->decimal('rentability', 10, 2);
            $table->text('datails')->nullable();
            $table->enum('unity_type', ['unit', 'volume', 'weight']);
            $table->string('unit_of_measure')->nullable(); // ejp: "cc", "gr", "ml", "kg", "lt", "g", "unity"

            // Relacion con marcas
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
