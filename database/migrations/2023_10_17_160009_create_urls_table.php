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
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('name_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table
            ->foreignId('surname_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table
            ->foreignId('phone_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table
            ->foreignId('email_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table
            ->foreignId('image_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
