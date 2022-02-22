<?php

if (!function_exists('feedback')) {
    function feedback($text = null, $type = 'primary')
    {
        return ['feedback' => compact('text', 'type')];
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        for ($i = count($units) - 1; $i >= 0; $i--) {
            if ($bytes >=  pow(1024, $i)) {
                return number_format((float) $bytes / pow(1024, $i), $precision) . " " . $units[$i];
            }
        }
        return $bytes . ' Bytes';
    }
}
