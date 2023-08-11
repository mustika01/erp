<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kumi\Senzou\Support\DatabaseTableNames;
use Kumi\Sousa\Support\DatabaseTableNames as SousaDatabaseTableNames;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::VESSEL_USERS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vessel_id')
                ->constrained(SousaDatabaseTableNames::VESSELS)
            ;

            $table->string('position');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->unique(['vessel_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::VESSEL_USERS);
    }
};
