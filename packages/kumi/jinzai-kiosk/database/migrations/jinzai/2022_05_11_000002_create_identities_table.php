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
        Schema::create(DatabaseTableNames::IDENTITIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('employee_id')->constrained(DatabaseTableNames::EMPLOYEES);

            $table->string('type');
            $table->string('number');
            $table->date('expired_at')->nullable();
            $table->text('remarks')->nullable();

            $table->unique(['employee_id', 'type', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::IDENTITIES);
    }
};
