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
        Schema::table('doacao_produto_ongs', function (Blueprint $table) {
            $table->date('ate')->default('9999-12-31');
          
         
        });
        Schema::table('doacao_produtos', function (Blueprint $table) {
         
            $table->date('ate')->default('9999-12-31');
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
