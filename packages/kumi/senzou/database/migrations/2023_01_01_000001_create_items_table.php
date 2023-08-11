<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kumi\Senzou\Support\DatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::ITEMS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('unit_of_measurement');
            $table->string('measurement_symbol')
                ->nullable()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::ITEMS);
    }
};
