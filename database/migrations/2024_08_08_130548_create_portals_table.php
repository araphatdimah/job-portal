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
        Schema::create('portals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('industry');
            $table->string('job_style');
            $table->string('skills_set');
            $table->string('qualification');
            $table->integer('required_experience');
            $table->string('location');
            $table->mediumText('biography');
            $table->string('documents')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portals');
    }
};
