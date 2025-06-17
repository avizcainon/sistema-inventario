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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_producto')->unique();
             $table->string('imagen_producto')->nullable();
            $table->string('descripcion_producto');
            $table->decimal('cantidad_producto',11,2);
            $table->decimal('monto_producto_compra',11,2);
            $table->decimal('monto_producto_venta',11,2);
            $table->string('medida_producto');
            $table->unsignedBigInteger('id_status_producto');
            $table->timestamps();
            $table->foreign('id_status_producto')->references('id')->on('status_productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
