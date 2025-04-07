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
    Schema::table('posts', function (Blueprint $table) {
        $table->enum('category', [
            'Novidades do Sistema',
            'Tutoriais e Dicas',
            'Processos Maçônicos',
            'Funcionalidades em Destaque'
        ])->default('Funcionalidades em Destaque')->after('media');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
