<?php


use App\Models\Book;
use App\Models\Genre;
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
        Schema::create('book_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book:: class, 'book_id')
            ->constrained('books')->cascadeOnDelete();
            $table->foreignIdFor(Genre:: class, 'genre_id')
            ->constrained('genres')->cascadeOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_genre');
    }
};
