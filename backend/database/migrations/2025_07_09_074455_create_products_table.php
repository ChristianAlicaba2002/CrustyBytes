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
            $table->id('id')->primary()->autoIncrement(false);
            $table->string('name');
            $table->string('description')->nullable()->default('This item has no description yet.');
            $table->enum('category', ['pizza','drink','dessert'])->default('pizza');
            $table->enum('size', ['small', 'medium', 'large'])->default('medium');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
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
