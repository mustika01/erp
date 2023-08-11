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
        Schema::create(DatabaseTableNames::BUNKER_JOURNALS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('bunker_id')
                ->constrained(DatabaseTableNames::BUNKERS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->dateTime('date');
            $table->text('description')->nullable();
            $table->decimal('rob_amount', 9, 3);
            $table->decimal('remainder', 9, 3);
            $table->dateTime('committed_at')->nullable();
        });

        Schema::create(DatabaseTableNames::BUNKER_JOURNAL_ENTRIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('journal_id')
                ->constrained(DatabaseTableNames::BUNKER_JOURNALS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('type');
            $table->string('engine')->nullable();
            $table->string('formula')->nullable();
            $table->string('hourly_consumption')->nullable();
            $table->dateTime('time_started_at')->nullable();
            $table->dateTime('time_finished_at')->nullable();
            $table->integer('total_minutes')->nullable();
            $table->decimal('total_refuel', 9, 3)->nullable();
            $table->decimal('total_usage', 9, 3)->nullable();
            $table->decimal('total_adjustment', 9, 3)->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::BUNKER_JOURNAL_ENTRIES);
        Schema::dropIfExists(DatabaseTableNames::BUNKER_JOURNALS);
    }
};
