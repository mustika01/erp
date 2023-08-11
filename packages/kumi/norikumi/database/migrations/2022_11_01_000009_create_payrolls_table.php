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
        Schema::create(DatabaseTableNames::PAYROLLS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('crew_id')->constrained(DatabaseTableNames::CREWS);

            $table->integer('salary')->nullable();
            $table->string('salary_type')->nullable();
            $table->integer('salary_grade')->nullable();

            $table->string('tax_number');
            $table->string('non_taxable_income_status');

            $table->string('social_security_number')->nullable();

            $table->string('health_care_number')->nullable();
            $table->integer('health_care_family_count')->nullable();
            $table->string('health_care_covering_entity')->nullable();
            $table->timestamp('activated_at')->nullable();
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
