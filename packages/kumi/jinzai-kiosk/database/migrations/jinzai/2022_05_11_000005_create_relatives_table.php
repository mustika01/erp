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
        Schema::create(DatabaseTableNames::RELATIVES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('employee_id')->constrained(DatabaseTableNames::EMPLOYEES);

            $table->string('name');
            $table->string('identity_card_number');
            $table->string('gender');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth');
            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('married_at')->nullable();
            $table->string('relation');
            $table->string('nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('permanent_resident_card_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
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
