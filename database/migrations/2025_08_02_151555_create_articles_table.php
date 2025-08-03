<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            // Article title (string field)
            $table->string('title');
            // Article content (text field for longer content)
            $table->text('body');
            // Foreign key to users table - links article to its author
            // onDelete('cascade') means if user is deleted, their articles are also deleted
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
