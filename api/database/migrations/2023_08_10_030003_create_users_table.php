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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('cpf', 11);
            $table->string('email', 200,)->unique();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('papel_id')->nullable();
            $table->timestamps();

            $table->foreign('papel_id')->references('id')->on('papel')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
