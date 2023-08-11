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
        Schema::create(DatabaseTableNames::VOYAGE_CITIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
        });

        Schema::create(DatabaseTableNames::VOYAGE_PORTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('city_id')
                ->constrained(DatabaseTableNames::VOYAGE_CITIES)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('name');
        });

        Schema::create(DatabaseTableNames::VESSEL_VOYAGES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vessel_id')
                ->constrained(DatabaseTableNames::VESSELS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('number')->nullable();
            $table->boolean('is_returning');

            $table->foreignId('origin_city_id')
                ->constrained(DatabaseTableNames::VOYAGE_CITIES)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->foreignId('origin_port_id')
                ->constrained(DatabaseTableNames::VOYAGE_PORTS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->foreignId('destination_city_id')
                ->constrained(DatabaseTableNames::VOYAGE_CITIES)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->foreignId('destination_port_id')
                ->constrained(DatabaseTableNames::VOYAGE_PORTS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('cargo_content')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::VESSEL_VOYAGES);
        Schema::dropIfExists(DatabaseTableNames::VOYAGE_PORTS);
        Schema::dropIfExists(DatabaseTableNames::VOYAGE_CITIES);
    }
};
