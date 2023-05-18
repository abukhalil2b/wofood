<?php

use App\Models\Group;
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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('active')->default(1);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->default('normal');//admin - normal
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->foreignIdFor(Group::class)->default(1);// each user belong to group
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
