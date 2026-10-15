<?php


use App\Models\Author;
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
        Schema::create('author_profiles', function (Blueprint $table) {
            $table->id();
             $table->foreignIdFor(Author:: class, 'author_id')->unique()
            ->constrained('authors')->cascadeOnDelete();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_profiles');
    }
};
