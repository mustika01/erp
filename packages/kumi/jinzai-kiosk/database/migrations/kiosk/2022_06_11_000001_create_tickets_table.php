<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kumi\Kiosk\Support\DatabaseTableNames as KioskDatabaseTableNames;
use Kumi\Jinzai\Support\DatabaseTableNames as JinzaiDatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(KioskDatabaseTableNames::TICKET_CATEGORIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('parent_id')->nullable()->constrained(KioskDatabaseTableNames::TICKET_CATEGORIES);

            $table->string('label');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
        });

        Schema::create(KioskDatabaseTableNames::TICKETS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('employee_id')->constrained(JinzaiDatabaseTableNames::EMPLOYEES);
            $table->foreignId('category_id')->constrained(KioskDatabaseTableNames::TICKET_CATEGORIES);
            $table->foreignId('child_category_id')->nullable()->constrained(KioskDatabaseTableNames::TICKET_CATEGORIES);
            $table->foreignId('grand_child_category_id')->nullable()->constrained(KioskDatabaseTableNames::TICKET_CATEGORIES);
            $table->text('description')->nullable();
            $table->json('properties')->nullable();

            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(KioskDatabaseTableNames::TICKETS);
        Schema::dropIfExists(KioskDatabaseTableNames::TICKET_CATEGORIES);
    }
};
