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
        //
        Schema::create('project_master', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->date('start_date');
            $table->integer('duration');
            $table->date('end_date');
            $table->foreignId('created_by')->constrained('users'); 
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps(); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
