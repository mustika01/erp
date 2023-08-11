<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Kumi\Sousa\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::VESSEL_TRACKS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table
                ->foreignId('vessel_id')
                ->constrained(DatabaseTableNames::VESSELS)
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;

            $table->unsignedInteger('provider_tracking_id');
            $table->unsignedInteger('provider_asset_id');
            $table->unsignedDecimal('latitude', 10, 7);
            $table->unsignedDecimal('longitude', 10, 7);
            $table->unsignedDecimal('speed', 4, 2);
            $table->string('cardinal_direction');
            $table->integer('cardinal_angle');
            $table->string('status');
            $table->datetime('tracking_started_at');
            $table->datetime('tracking_finished_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::VESSEL_TRACKS);
    }
};
