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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->string('username')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique()->nullable();
            $table->rememberToken();
            $table->string('role')->default('user')->index();
            $table->boolean('is_active')->default(true)->index();
            $table->foreignUuid('store_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.~
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
