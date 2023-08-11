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
        Schema::table(DatabaseTableNames::BUNKERS, function (Blueprint $table) {
            $table->decimal('type_90_amount', 8, 3)->default(0);
            $table->decimal('type_40_amount', 8, 3)->default(0);
            $table->decimal('type_10_amount', 8, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::BUNKERS, function (Blueprint $table) {
        });
    }
};
