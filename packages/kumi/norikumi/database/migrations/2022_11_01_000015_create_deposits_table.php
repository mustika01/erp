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
        Schema::create(DatabaseTableNames::DEPOSITS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payroll_id')->constrained(DatabaseTableNames::PAYROLLS);

            $table->datetime('started_at');
            $table->datetime('finalized_at');
            $table->integer('deposit_amount');
            $table->integer('installment_amount');
        });

        Schema::create(DatabaseTableNames::DEPOSIT_PAYMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('deposit_id')->constrained(DatabaseTableNames::DEPOSITS);
            $table->integer('amount');
            $table->datetime('paid_at');
            $table->integer('sequence')->nullable();
            $table->integer('total_sequence')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::DEPOSIT_PAYMENTS);
        Schema::dropIfExists(DatabaseTableNames::DEPOSITS);
    }
};
