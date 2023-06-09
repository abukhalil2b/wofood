<?php

use App\Models\Day;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Group;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(Group::class)->nullable();
            $table->unsignedBigInteger('assign_for_id')->nullable();// for whom this is task assigned
            $table->unsignedBigInteger('assign_by_id')->nullable();// who assigned this task
            $table->foreignIdFor(Day::class)->nullable();// this task should be done in ... ?
            $table->time('start_at')->nullable();// write starting date
            $table->time('end_at')->nullable();// write starting date
            $table->timestamp('done_at')->nullable();// write done date
            $table->string('consent')->default('yes');// iin case of having a circumstance
            $table->text('note')->nullable();// in case of refuse
            $table->integer('taskcat_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
