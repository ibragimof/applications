<?php

if (! function_exists('convert_date_format')) {
    function convert_date_format(string $format): string
    {
        $replacements = [
            // Year
            'Y' => 'yyyy',    // 2024
            'y' => 'yy',      // 24

            // Month
            'm' => 'mm',      // 01-12
            'n' => 'm',       // 1-12
            'F' => 'MM',      // January
            'M' => 'M',       // Jan

            // Day
            'd' => 'dd',      // 01-31
            'j' => 'd',       // 1-31
            'D' => 'D',       // Mon
            'l' => 'DD',       // Monday
        ];

        return strtr($format, $replacements);
    }
}
