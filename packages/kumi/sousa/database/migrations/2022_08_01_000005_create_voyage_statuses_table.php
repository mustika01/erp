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
        Schema::create(DatabaseTableNames::VOYAGE_STATUSES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('voyage_id')
                ->constrained(DatabaseTableNames::VESSEL_VOYAGES)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('description');
            $table->dateTime('executed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::VOYAGE_STATUSES);
    }
};
