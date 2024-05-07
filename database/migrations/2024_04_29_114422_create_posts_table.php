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
        Schema::create('posts', function (Blueprint $table) {
            // bigIncrements - auto increment
            $table->bigIncrements('id');
            $table->string('title');
            // text - store large amount
            $table->text('content');
            // unsignedBigInteger only stores positive integer
            $table->unsignedBigInteger('user_id');
            // timestamps - create 2 columns(created_at, updated_at)
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
