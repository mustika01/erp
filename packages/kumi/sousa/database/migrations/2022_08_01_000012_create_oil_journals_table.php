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
        Schema::create(DatabaseTableNames::OIL_JOURNALS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('bunker_id')
                ->constrained(DatabaseTableNames::BUNKERS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->dateTime('date');

            $table->decimal('rob_amount_type_90', 8, 3)->nullable();
            $table->decimal('remainder_type_90', 8, 3)->nullable();
            $table->decimal('rob_amount_type_40', 8, 3)->nullable();
            $table->decimal('remainder_type_40', 8, 3)->nullable();
            $table->decimal('rob_amount_type_10', 8, 3)->nullable();
            $table->decimal('remainder_type_10', 8, 3)->nullable();

            $table->dateTime('committed_at')->nullable();
        });

        Schema::create(DatabaseTableNames::OIL_JOURNAL_ENTRIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('oil_journal_id')
                ->constrained(DatabaseTableNames::OIL_JOURNALS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('entry_type');
            $table->string('oil_type');
            $table->decimal('total_litre', 8, 3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::OIL_JOURNAL_ENTRIES);
        Schema::dropIfExists(DatabaseTableNames::OIL_JOURNALS);
    }
};
