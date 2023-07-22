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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('short_link');
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->index(); // Assuming user_id is a foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
