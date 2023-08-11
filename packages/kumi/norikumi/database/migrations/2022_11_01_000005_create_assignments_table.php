<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Kumi\Sousa\Support\DatabaseTableNames as SousaDatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::ASSIGNMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('crew_id')->constrained(DatabaseTableNames::CREWS);
            $table->foreignId('vessel_id')->constrained(SousaDatabaseTableNames::VESSELS);

            $table->string('position');
            $table->integer('grade')->nullable();
            $table->date('assigned_at');
            $table->date('retracted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::ASSIGNMENTS);
    }
};
