<?php

namespace Quinton\Applications\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

class EducationDegreeEnum extends Enum
{
    public const BACHELOR = 'bachelor';

    public const MASTERS = 'masters';

    public const PHD = 'phd';

    public static $langPath = 'plugins/applications::application.education_degrees';

    public function toHtml(): HtmlString|string
    {
        return BaseHelper::renderBadge($this->label());
    }
}
