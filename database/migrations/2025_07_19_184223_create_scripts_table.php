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
        Schema::create('scripts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('writer_id')->nullable()->constrained('writers')->onDelete('cascade');
            $table->year('year')->nullable();;
            $table->string('file_path');
            $table->text('one_liner')->nullable();;
            $table->text('short_synopsis')->nullable();
            $table->string('era')->nullable();
            $table->string('suggested_style')->nullable();
            $table->string('expected_impact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scripts');
    }
};
