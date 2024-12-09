<?php

namespace Quinton\Applications\Events;

use Botble\Base\Events\Event;
use Botble\Base\Models\BaseModel;
use Illuminate\Queue\SerializesModels;

class SentApplicationEvent extends Event
{
    use SerializesModels;

    public function __construct(public bool|BaseModel|null $data)
    {
    }
}
