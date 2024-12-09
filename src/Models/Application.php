<?php

namespace Quinton\Applications\Models;

use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\Avatar;
use Botble\Media\Facades\RvMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Quinton\Applications\Enums\ApplicationStatusEnum;
use Quinton\Applications\Enums\EducationDegreeEnum;
use Quinton\Applications\Enums\GenderEnum;
use Throwable;

class Application extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'gender',
        'citizenship',
        'date_of_birth',
        'phone',
        'country',
        'region',
        'address',
        'known_languages',
        'education_university',
        'education_degree',
        'education_faculty',
        'education_specialization',
        'additional_education',
        'education_diploma_file',
        'education_started_at',
        'education_ended_at',
        'work_experience_last_workplace',
        'work_experience_later_workplaces',
        'work_experience_position',
        'work_experience_started_at',
        'work_experience_ended_at',
        'cv_file',
        'social_activity_organization',
        'social_activity_type',
        'motivation_essay',
        'value_proposition_essay',
        'benefit_essay',
        'is_available_full_time',
        'can_attend_summer_institute',
        'agreed_to_terms',
        'status',
    ];

    protected $appends = [
        'name',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'education_started_at' => 'date',
        'education_ended_at' => 'date',
        'work_experience_started_at' => 'date',
        'work_experience_ended_at' => 'date',
        'is_available_full_time' => 'boolean',
        'can_attend_summer_institute' => 'boolean',
        'agreed_to_terms' => 'boolean',
        'known_languages' => 'array',
        'status' => ApplicationStatusEnum::class,
        'education_degree' => EducationDegreeEnum::class,
        'gender' => GenderEnum::class,
    ];

    public function name(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            $firstName = $attributes['first_name'] ?? '';
            $lastName = $attributes['last_name'] ?? '';

            return trim($firstName . ' ' . $lastName);
        });
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ApplicationReply::class);
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function () {
            try {
                return Avatar::createBase64Image($this->name);
            } catch (Throwable) {
                return RvMedia::getDefaultImage();
            }
        });
    }
}
