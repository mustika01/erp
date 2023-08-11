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
        Schema::create(DatabaseTableNames::REGISTRATION_FORM_ENTRIES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('department');
            $table->integer('pin_code');
            $table->datetime('completed_at')->nullable();
            $table->json('properties')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::REGISTRATION_FORM_ENTRIES);
    }
};
