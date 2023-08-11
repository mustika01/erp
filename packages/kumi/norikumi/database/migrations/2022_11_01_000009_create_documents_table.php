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
        Schema::create(DatabaseTableNames::DOCUMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('crew_id')->constrained(DatabaseTableNames::CREWS);

            $table->string('type');
            $table->string('number');
            $table->date('expired_at')->nullable();
            $table->text('remarks')->nullable();

            $table->unique(['crew_id', 'type', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::DOCUMENTS);
    }
};
