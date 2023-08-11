<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kumi\Sousa\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(DatabaseTableNames::VESSEL_DOCUMENTS, function (Blueprint $table) {
            $table->dateTime('endorse_period_started_at')->nullable();
            $table->dateTime('endorse_period_finished_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::VESSEL_DOCUMENTS, function (Blueprint $table) {
            $table->dropColumn('endorse_period_started_at');
            $table->dropColumn('endorse_period_finished_at');
        });
    }
};
