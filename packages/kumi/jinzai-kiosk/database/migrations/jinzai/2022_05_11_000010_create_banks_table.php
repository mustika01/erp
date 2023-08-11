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
        Schema::create(DatabaseTableNames::BANKS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table
                ->foreignId('payroll_id')
                ->constrained(DatabaseTableNames::PAYROLLS)
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;

            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder_name');
            $table->boolean('is_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::BANKS);
    }
};
