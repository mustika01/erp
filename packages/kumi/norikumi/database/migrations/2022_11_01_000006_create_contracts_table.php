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
        Schema::create(DatabaseTableNames::CONTRACTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('crew_id')->constrained(DatabaseTableNames::CREWS);

            $table->string('position');
            $table->string('grade')->nullable();
            $table->date('started_at');
            $table->date('ended_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::CONTRACTS);
    }
};
