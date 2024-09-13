<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->unique(); // Número de tarjeta, único
            $table->string('card_type'); // Tipo de tarjeta (Visa o AMEX)
            $table->string('bank_name'); // Nombre del banco
            $table->decimal('limit', 10, 2); // Límite disponible
            $table->string('dni'); // DNI del titular
            $table->string('first_name'); // Nombre del titular
            $table->string('last_name'); // Apellido del titular
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
