<?php

namespace Quinton\Applications\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;

class ApplicationReply extends BaseModel
{
    protected $table = 'application_replies';

    protected $fillable = [
        'message',
        'application_id',
    ];

    protected $casts = [
        'message' => SafeContent::class,
    ];
}
