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
        Schema::create(DatabaseTableNames::ONBOARDING_LINKS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('employee_id')->constrained(DatabaseTableNames::EMPLOYEES);

            $table->string('token')->unique();
            $table->timestamp('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::ONBOARDING_LINKS);
    }
};
