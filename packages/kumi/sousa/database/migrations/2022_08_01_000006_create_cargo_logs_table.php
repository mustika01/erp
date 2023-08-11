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
        Schema::create(DatabaseTableNames::CARGO_LOGS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('voyage_id')
                ->constrained(DatabaseTableNames::VESSEL_VOYAGES)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->boolean('is_loading');
            $table->integer('tonnage_amount');
            $table->text('remarks')->nullable();
            $table->dateTime('executed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::CARGO_LOGS);
    }
};
