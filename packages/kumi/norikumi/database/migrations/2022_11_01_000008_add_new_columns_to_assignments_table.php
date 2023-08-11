<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kumi\Norikumi\Support\DatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(DatabaseTableNames::ASSIGNMENTS, function (Blueprint $table) {
            $table->string('seafare_code')->nullable();
            $table->integer('no_pkl')->nullable();
            $table->string('ship_owner')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('premi')->nullable();
            $table->integer('deposit')->nullable();
            $table->string('term')->nullable();
            $table->string('month_started')->nullable();
            $table->string('month_ended')->nullable();
            $table->string('place')->nullable();
            $table->date('sijil_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::ASSIGNMENTS, function (Blueprint $table) {
            $table->dropColumn('seafare_code');
            $table->dropColumn('no_pkl');
            $table->dropColumn('ship_owner');
            $table->dropColumn('salary');
            $table->dropColumn('premi');
            $table->dropColumn('deposit');
            $table->dropColumn('term');
            $table->dropColumn('month_started');
            $table->dropColumn('month_ended');
            $table->dropColumn('place');
            $table->dropColumn('sijil_date');
        });
    }
};
