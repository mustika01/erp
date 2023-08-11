<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kumi\Kanri\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::REPORTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('reportable_type');

            $table->datetime('started_at');
            $table->datetime('finalized_at');
            $table->json('properties')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::REPORTS);
    }
};
