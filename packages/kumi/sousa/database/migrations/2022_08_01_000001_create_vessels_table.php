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
        Schema::create(DatabaseTableNames::VESSELS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedInteger('tracking_asset_id')->nullable();
            $table->string('tracking_provider_name')->nullable();

            $table->string('name');
            $table->string('slug');

            $table->json('properties')->nullable();

            $table->unique(['tracking_asset_id', 'tracking_provider_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::VESSELS);
    }
};
