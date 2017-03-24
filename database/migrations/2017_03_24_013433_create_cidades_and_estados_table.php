<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesAndEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pais', function(Blueprint $table) {

            $table->increments('id');
            $table->string('nome', 60)->default(null);
            $table->string('sigla', 10)->default(null);

        });

        Schema::create('estados', function(Blueprint $table) {

            $table->increments('id');
            $table->string('nome', 75)->default(null);
            $table->string('uf', 5)->default(null);
            $table->integer('pais')->default(null);

            $table->index('pais','fk_Estados_pais');

        });

        Schema::create('cidades', function(Blueprint $table) {

            $table->increments('id');
            $table->string('nome', 120)->default(null);
            $table->integer('estado')->default(null);

            $table->index('estado','fk_Cidades_estado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pais');
        Schema::dropIfExists('estados');
        Schema::dropIfExists('cidades');
    }
}
