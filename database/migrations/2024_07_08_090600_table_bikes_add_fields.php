<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBikesAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Create nuevos campos matrícula y color
        Schema::table('bikes', function(Blueprint $table){
            $table->string('matricula', 7)->unique()->after('matriculada')->nullable();
            $table->string('color',7)->after('matricula')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        # Eliminar los campos creados
        Schema::table('bikes',function(Blueprint $table){
            $table->dropColumn('matricula');
            $table->dropColumn('color');

        });
    }
}
