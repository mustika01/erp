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
        Schema::create(DatabaseTableNames::DISBURSEMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payout_id')->constrained(DatabaseTableNames::PAYOUTS);

            $table->string('vendor_assigned_id');
            $table->uuid('reference_id');
            $table->string('description');
            $table->integer('amount');
            $table->string('status');
            $table->json('disbursement_method');
            $table->string('error_code')->nullable();
            $table->string('error_reason')->nullable();
            $table->json('create_response');
            $table->json('processing_response')->nullable();
            $table->json('failed_response')->nullable();
            $table->json('completed_response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::DISBURSEMENTS);
    }
};
