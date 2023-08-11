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
        Schema::create(DatabaseTableNames::BUNKERS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vessel_id')
                ->constrained(DatabaseTableNames::VESSELS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->decimal('rob_amount', 8, 3);
        });

        Schema::create(DatabaseTableNames::BUNKER_ENGINES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('bunker_id')
                ->constrained(DatabaseTableNames::BUNKERS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('label');
            $table->text('description')->nullable();

            $table->unique(['bunker_id', 'label']);
        });

        Schema::create(DatabaseTableNames::BUNKER_FORMULAS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('bunker_id')
                ->constrained(DatabaseTableNames::BUNKERS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->foreignId('engine_id')
                ->constrained(DatabaseTableNames::BUNKER_ENGINES)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('label');
            $table->text('description')->nullable();
            $table->decimal('hourly_consumption', 8, 3);

            $table->unique(['engine_id', 'label']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::BUNKER_FORMULAS);
        Schema::dropIfExists(DatabaseTableNames::BUNKER_ENGINES);
        Schema::dropIfExists(DatabaseTableNames::BUNKERS);
    }
};
