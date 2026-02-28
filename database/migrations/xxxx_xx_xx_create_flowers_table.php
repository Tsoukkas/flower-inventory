<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('name', 160);
            $table->string('type', 120)->nullable(); // π.χ. "Bouquet", "Single stem"
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);

            // Bonus: image upload
            $table->string('image_path', 255)->nullable();

            $table->timestamps();

            $table->index(['name', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flowers');
    }
};