<?php

namespace Quinton\Applications\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

class GenderEnum extends Enum
{
    public const MALE = 'male';

    public const FEMALE = 'female';

    public static $langPath = 'plugins/applications::application.genders';

    public function toHtml(): HtmlString|string
    {
        return BaseHelper::renderBadge($this->label());
    }
}
