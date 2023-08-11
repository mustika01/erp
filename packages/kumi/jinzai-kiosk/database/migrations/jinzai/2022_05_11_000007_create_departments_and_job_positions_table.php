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
        Schema::create(DatabaseTableNames::DEPARTMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create(DatabaseTableNames::JOB_POSITIONS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('department_id')
                ->constrained(DatabaseTableNames::DEPARTMENTS)
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;

            $table->string('name');
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::JOB_POSITIONS);
        Schema::dropIfExists(DatabaseTableNames::DEPARTMENTS);
    }
};
