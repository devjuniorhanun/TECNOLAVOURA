<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('produtors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('proprietario_id')->constrained();
            $table->uuid('uuid');
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
        Schema::dropIfExists('produtors');
    }
}
