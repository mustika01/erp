<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kumi\Senzou\Support\DatabaseTableNames;
use Kumi\Sousa\Support\DatabaseTableNames as SousaDatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::DELIVERY_NOTES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vessel_id')
                ->constrained(SousaDatabaseTableNames::VESSELS)
            ;

            $table->date('date');
            $table->date('committed_at')
                ->nullable()
            ;
        });

        Schema::create(DatabaseTableNames::DELIVERY_NOTE_ENTRIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('delivery_note_id')
                ->constrained(DatabaseTableNames::DELIVERY_NOTES)
            ;
            $table->foreignId('item_id')
                ->constrained(DatabaseTableNames::ITEMS)
            ;

            $table->integer('quantity');
            $table->string('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::DELIVERY_NOTE_ENTRIES);
        Schema::dropIfExists(DatabaseTableNames::DELIVERY_NOTES);
    }
};
