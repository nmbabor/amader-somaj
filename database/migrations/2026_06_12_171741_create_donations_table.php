<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2);
            // method: bkash | nagad | cash | bank
            $table->string('method')->default('bkash');
            $table->string('transaction_id')->nullable();
            // status: pending | verified | rejected
            $table->string('status')->default('pending')->index();
            $table->text('note')->nullable();
            $table->timestamp('donated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};