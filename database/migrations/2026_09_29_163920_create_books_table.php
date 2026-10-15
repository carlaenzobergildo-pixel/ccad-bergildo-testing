<?php


use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
             $table->foreignIdFor(Author:: class, 'author_id')
            ->constrained('authors')->cascadeOnDelete();
             $table->foreignIdFor(Publisher:: class, 'publisher_id')
            ->constrained('publishers')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('isbn');
            $table->decimal('price', 8,2);
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
