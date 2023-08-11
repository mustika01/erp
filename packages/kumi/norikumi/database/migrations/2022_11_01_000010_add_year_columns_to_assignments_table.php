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
            $table->string('year_started')->nullable();
            $table->string('year_ended')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::ASSIGNMENTS, function (Blueprint $table) {
            $table->dropColumn('year_started');
            $table->dropColumn('year_ended');
        });
    }
};
