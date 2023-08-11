<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kumi\Yoyaku\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;
use Kumi\Jinzai\Support\DatabaseTableNames as JinzaiDatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::BOOKINGS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table
                ->foreignId('employee_id')
                ->constrained(JinzaiDatabaseTableNames::EMPLOYEES)
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;

            $table
                ->foreignId('bookable_id')
                ->constrained(DatabaseTableNames::BOOKABLES)
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;

            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::BOOKINGS);
    }
};
