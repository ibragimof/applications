<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('middle_name', 60)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('gender', 60)->nullable();
            $table->string('citizenship', 60);
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 60)->nullable();
            $table->string('country', 60)->nullable();
            $table->string('region')->nullable();
            $table->text('address')->nullable();
            $table->text('known_languages')->nullable();

            $table->string('education_university');
            $table->string('education_degree');
            $table->string('education_faculty');
            $table->string('education_specialization')->nullable();
            $table->text('additional_education')->nullable();
            $table->text('education_diploma_file')->nullable();
            $table->date('education_started_at');
            $table->date('education_ended_at');

            $table->string('work_experience_last_workplace')->nullable();
            $table->string('work_experience_later_workplaces')->nullable();
            $table->string('work_experience_position')->nullable();
            $table->string('work_experience_started_at')->nullable();
            $table->string('work_experience_ended_at')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('social_activity_organization')->nullable();
            $table->string('social_activity_type')->nullable();

            $table->text('motivation_essay')->nullable();
            $table->text('value_proposition_essay')->nullable();
            $table->text('benefit_essay')->nullable();

            $table->boolean('is_available_full_time');
            $table->boolean('can_attend_summer_institute');

            $table->boolean('agreed_to_terms')->default(false);

            $table->string('status')->default('new');

            $table->timestamps();
        });

        Schema::create('application_replies', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->foreignId('application_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
        Schema::dropIfExists('application_replies');
    }
};
