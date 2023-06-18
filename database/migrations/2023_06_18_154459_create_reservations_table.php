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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('field_id')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('timeslot_id');
            $table->unsignedBigInteger('section_id');
            $table->foreign('field_id')
                ->references('id')
                ->on('fields')
                ->onDelete('cascade');
            $table->foreign('table_id')
                ->references('id')
                ->on('tables')
                ->onDelete('cascade');
            $table->foreign('timeslot_id')
            ->references('id')
            ->on('time_slots')
            ->onDelete('cascade');
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
