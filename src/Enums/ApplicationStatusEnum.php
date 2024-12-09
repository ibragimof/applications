<?php

namespace Quinton\Applications\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

class ApplicationStatusEnum extends Enum
{
    public const NEW = 'new';

    public const READ_REJECTED = 'read_rejected';

    public const INTERVIEW = 'interview';

    public const INTERVIEW_REJECTED = 'interview_rejected';

    public const ASSESSMENT = 'assessment';

    public const ASSESSMENT_REJECTED = 'assessment_rejected';

    public const SUMMER_INSTITUTE = 'summer_institute';

    public const SUMMER_INSTITUTE_REJECTED = 'summer_institute_rejected';

    public const FELLOW = 'fellow';

    public const FINISHED = 'finished';

    public static $langPath = 'plugins/applications::application.statuses';

    public function toHtml(): HtmlString|string
    {
        $color = match ($this->value) {
            self::NEW => 'success',
            self::READ_REJECTED => 'dark',
            self::ASSESSMENT_REJECTED, self::INTERVIEW_REJECTED, self::SUMMER_INSTITUTE_REJECTED => 'danger',
            self::INTERVIEW, self::ASSESSMENT, self::SUMMER_INSTITUTE => 'warning',
            self::FELLOW => 'primary',
            default => 'secondary',
        };

        return BaseHelper::renderBadge($this->label(), $color);
    }
}
