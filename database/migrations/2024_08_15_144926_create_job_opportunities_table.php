<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('job_style');
            $table->string('location');
            $table->integer('salary');
            $table->integer('required_experience');
            $table->text('required_skills');
            $table->string('qualification');
            $table->mediumText('description');
            $table->date('deadline');
            $table->string('cover_image');
            $table->foreignIdFor(Employer::class);
            $table->string('employer_name');
            $table->string('employer_email');
            $table->string('employer_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_opportunities');
    }
};
