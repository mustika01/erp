<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kumi\Yoyaku\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::BOOKABLES, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::BOOKABLES);
    }
};
