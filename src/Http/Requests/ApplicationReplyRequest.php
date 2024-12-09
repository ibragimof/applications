<?php

namespace Quinton\Applications\Http\Requests;

use Botble\Support\Http\Requests\Request;

class ApplicationReplyRequest extends Request
{
    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'max:10000'],
        ];
    }
}
