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
            $table->string('user_name',30)->nullable(false)->min(3);
            $table->string('email',128)->unique()->nullable(false);
            $table->string('password',64)->nullable(false)->min(8);
            $table->string('first_name',20)->nullable(false)->min(3)->alpha();
            $table->string('last_name',15)->alpha()->nullable();
            $table->enum('role',['admin','partner','customer'])->nullable(false);
            $table->string('profile_picture')->nullable(false);
            $table->enum('status',['active','inactive','inprogress'])->nullable(false)->default('inprogress');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
