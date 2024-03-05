<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recepients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_uuid')->constrained('users', 'uuid');
            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepients');
    }
};
