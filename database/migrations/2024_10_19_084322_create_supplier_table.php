<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();  // Ini akan membuat auto-increment primary key
            $table->string('supplier_name');
            $table->string('supplier_address');
            $table->string('phone');
            $table->string('comment')->nullable();  // Tambahkan nullable() karena optional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};