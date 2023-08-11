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
        Schema::create(DatabaseTableNames::REQUEST_NOTES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vessel_user_id')
                ->constrained(DatabaseTableNames::VESSEL_USERS)
            ;

            $table->string('location');
            $table->string('voyage_number');
            $table->string('remarks');
            $table->string('delivery_requirement');
            $table->string('status');

            $table->date('committed_at')
                ->nullable()
            ;

            $table->date('approved_at')
                ->nullable()
            ;
        });

        Schema::create(DatabaseTableNames::REQUEST_NOTE_ITEMS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('request_note_id')
                ->constrained(DatabaseTableNames::REQUEST_NOTES)
            ;

            $table->string('name');
            $table->integer('quantity');
            $table->integer('stock_on_vessel');
            $table->string('reason');
            $table->string('status');

            $table->date('committed_at')
                ->nullable()
            ;
        });

        Schema::create(DatabaseTableNames::REQUEST_NOTE_APPROVED_ITEMS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('request_note_id')
                ->constrained(DatabaseTableNames::REQUEST_NOTES)
            ;

            $table->foreignId('item_id')
                ->constrained(DatabaseTableNames::ITEMS)
            ;

            $table->integer('quantity');
            $table->integer('stock_on_vessel');
            $table->string('reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::REQUEST_NOTES);
        Schema::dropIfExists(DatabaseTableNames::REQUEST_NOTE_ITEMS);
        Schema::dropIfExists(DatabaseTableNames::REQUEST_NOTE_APPROVED_ITEMS);
    }
};
