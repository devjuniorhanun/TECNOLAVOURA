<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalhaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('talhaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('fazenda_id')->constrained();
            $table->uuid('uuid');
            $table->string('nome')->unique();
            $table->double('area_total', 10, 2);
            $table->string('bloco');
            $table->enum('status', ["ATIVO","DESATIVADO"]);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talhaos');
    }
}
