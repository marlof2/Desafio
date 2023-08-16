<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papel_permissao', function (Blueprint $table) {
            $table->unsignedBigInteger('permissao_id');
            $table->unsignedBigInteger('papel_id');
            $table->timestamps();

            $table->foreign('permissao_id')->references('id')->on('permissoes')->onDelete('cascade');
            $table->foreign('papel_id')->references('id')->on('papel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papel_permissao');
    }
};
