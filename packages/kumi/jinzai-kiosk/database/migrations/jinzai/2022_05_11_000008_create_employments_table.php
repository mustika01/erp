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
        Schema::create(DatabaseTableNames::EMPLOYMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('employee_id')->constrained(DatabaseTableNames::EMPLOYEES);
            $table->foreignId('department_id')->constrained(DatabaseTableNames::DEPARTMENTS);
            $table->foreignId('job_position_id')->constrained(DatabaseTableNames::JOB_POSITIONS);

            $table->string('status');
            $table->date('joined_at')->nullable();
            $table->date('left_at')->nullable();
            $table->date('resigned_at')->nullable();
            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::EMPLOYMENTS);
    }
};
