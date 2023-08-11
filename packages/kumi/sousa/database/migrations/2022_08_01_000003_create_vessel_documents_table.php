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
        Schema::create(DatabaseTableNames::VESSEL_DOCUMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vessel_id')
                ->constrained(DatabaseTableNames::VESSELS)
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;

            $table->string('name');
            $table->string('slug');
            $table->string('document_number')->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();

            $table->dateTime('issued_at');
            $table->dateTime('endorsed_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->boolean('is_permanent')->default(false);

            $table->integer('sortable_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::VESSEL_DOCUMENTS);
    }
};
