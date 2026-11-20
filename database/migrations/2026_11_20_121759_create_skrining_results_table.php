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
        Schema::create('skrining_results', function (Blueprint $table) {
            $table->id();
            $table->string('evaluation_id')->unique();
            
            // Data Formulir (Input User)
            $table->integer('usia');
            $table->string('jenis_kelamin', 1); // 'L' atau 'P'
            $table->float('tinggi'); 
            $table->float('berat');  
            $table->float('bmi');
            $table->string('riwayat_diabetes'); 
            $table->string('hipertensi');       
            $table->string('aktivitas');        
            $table->string('konsumsi');         
            
            // Hasil Prediksi AI
            $table->integer('skor_risiko'); 
            $table->string('kategori');     
            $table->string('confidence');   
            
            $table->timestamps(); // Ini akan membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skrining_results');
    }
};