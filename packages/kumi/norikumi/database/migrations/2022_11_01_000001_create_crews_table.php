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
        Schema::create(DatabaseTableNames::CREWS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('mobile');
            $table->string('landline')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('blood_type')->nullable();
            $table->string('religion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::CREWS);
    }
};
