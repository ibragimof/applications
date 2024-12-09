<?php

namespace Quinton\Applications\Http\Requests;

use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Quinton\Applications\Enums\ApplicationStatusEnum;

class EditApplicationRequest extends Request
{
    public function rules(): array
    {
        return [
            'status' => Rule::in(ApplicationStatusEnum::values()),
        ];
    }
}
