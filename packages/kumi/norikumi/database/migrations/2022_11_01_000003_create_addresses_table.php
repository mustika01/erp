<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kumi\Norikumi\Support\DatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::ADDRESSES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('crew_id')->constrained(DatabaseTableNames::CREWS);

            $table->string('label');
            $table->string('country_code_3');
            $table->string('state');
            $table->string('city');
            $table->integer('zip_code')->nullable();
            $table->string('street_line_1');
            $table->string('street_line_2')->nullable();
            $table->string('street_line_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::ADDRESSES);
    }
};
