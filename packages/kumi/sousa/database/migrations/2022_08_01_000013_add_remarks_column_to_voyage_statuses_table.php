<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kumi\Sousa\Support\DatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(DatabaseTableNames::VOYAGE_STATUSES, function (Blueprint $table) {
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::VOYAGE_STATUSES, function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};
