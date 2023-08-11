<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::LOANS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payroll_id')->constrained(DatabaseTableNames::PAYROLLS);

            $table->datetime('started_at');
            $table->datetime('finalized_at');
            $table->integer('loan_amount');
            $table->integer('installment_amount');
        });

        Schema::create(DatabaseTableNames::LOAN_PAYMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('loan_id')->constrained(DatabaseTableNames::LOANS);
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
        Schema::dropIfExists(DatabaseTableNames::LOAN_PAYMENTS);
        Schema::dropIfExists(DatabaseTableNames::LOANS);
    }
};
