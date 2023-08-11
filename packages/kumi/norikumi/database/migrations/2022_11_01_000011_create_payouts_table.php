<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kumi\Norikumi\Support\DatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::PAYOUTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payroll_id')->constrained(DatabaseTableNames::PAYROLLS);

            $table->text('description');
            $table->datetime('started_at');
            $table->datetime('finalized_at');
        });

        Schema::create(DatabaseTableNames::PAYOUT_ITEMS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payout_id')->constrained(DatabaseTableNames::PAYOUTS);

            $table->string('type');
            $table->string('description');
            $table->integer('amount');
            $table->text('remarks')->nullable();
            $table->json('properties')->nullable();

            $table->nullableMorphs('relatable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::PAYOUT_ITEMS);
        Schema::dropIfExists(DatabaseTableNames::PAYOUTS);
    }
};
