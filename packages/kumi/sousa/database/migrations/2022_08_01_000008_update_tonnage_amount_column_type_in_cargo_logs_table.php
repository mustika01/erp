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
        Schema::table(DatabaseTableNames::CARGO_LOGS, function (Blueprint $table) {
            $table->decimal('tonnage_amount')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::CARGO_LOGS, function (Blueprint $table) {
            $table->integer('tonnage_amount')->change();
        });
    }
};
