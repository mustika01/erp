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
        Schema::create(DatabaseTableNames::PAYROLLS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('employee_id')->constrained(DatabaseTableNames::EMPLOYEES);

            $table->integer('salary')->nullable();
            $table->string('salary_type')->nullable();
            $table->integer('salary_grade')->nullable();

            $table->string('tax_number');
            $table->string('non_taxable_income_status');

            $table->string('social_security_number')->nullable();

            $table->string('health_care_number')->nullable();
            $table->integer('health_care_family_count')->nullable();
            $table->string('health_care_covering_entity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::PAYROLLS);
    }
};
