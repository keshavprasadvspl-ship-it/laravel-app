<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Retrieve a website setting by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('wpautop')) {
    /**
     * Replaces double line-breaks with paragraph elements, matching WordPress wpautop.
     *
     * @param string $pee The text which has to be formatted.
     * @param bool $br Optional. If true, will also convert remaining single line breaks into <br />. Default true.
     * @return string Text which has been converted into correct paragraph tags.
     */
    function wpautop(string $pee, bool $br = true): string
    {
        $pre_tags = [];

        if (trim($pee) === '') {
            return '';
        }

        // Standardize newline characters
        $pee = str_replace(["\r\n", "\r"], "\n", $pee . "\n");

        // Preserve <pre> tags
        if (str_contains($pee, '<pre')) {
            $pee_parts = explode('</pre>', $pee);
            $last_pee  = array_pop($pee_parts);
            $pee       = '';
            $i         = 0;

            foreach ($pee_parts as $pee_part) {
                $start = strpos($pee_part, '<pre');
                if (false === $start) {
                    $pee .= $pee_part;
                    continue;
                }
                $name            = "<pre wp-pre-tag-$i></pre>";
                $pre_tags[$name] = substr($pee_part, $start) . '</pre>';
                $pee            .= substr($pee_part, 0, $start) . $name;
                $i++;
            }
            $pee .= $last_pee;
        }

        // Change multiple <br>'s into two line breaks
        $pee = preg_replace('|<br\s*/?>\s*<br\s*/?>|i', "\n\n", $pee);

        $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';

        // Add a double line break above block-level opening tags.
        $pee = preg_replace('!(<' . $allblocks . '[\s/>])!i', "\n\n$1", $pee);

        // Add a double line break below block-level closing tags.
        $pee = preg_replace('!(</' . $allblocks . '>)!i', "$1\n\n", $pee);

        // Collapse duplicate line breaks
        $pee = preg_replace("/\n\n+/", "\n\n", $pee);

        // Split at double newlines
        $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
        $pee  = '';

        foreach ($pees as $tinkle) {
            $trimmed = trim($tinkle, " \t\n\r\0\x0B");
            if ('' === $trimmed) {
                continue;
            }

            // If it starts with a block-level tag, do not wrap in <p>
            if (preg_match('!^<(?:' . $allblocks . ')[\s/>]!i', $trimmed)) {
                $pee .= $trimmed . "\n";
            } else {
                // It's text or inline elements (span, a, b, strong, etc.) -> wrap in <p>
                if ($br) {
                    $trimmed = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $trimmed);
                }
                $pee .= '<p>' . $trimmed . "</p>\n";
            }
        }

        // Remove empty <p></p>
        $pee = preg_replace('|<p>\s*</p>|i', '', $pee);

        // Restore pre tags
        if (!empty($pre_tags)) {
            $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);
        }

        // Clean up external host references
        $pee = preg_replace('#https?://(?:moccasin-worm-620280\.hostingersite\.com|sdinternational\.com)(?=/|\b)#i', '', $pee);

        return trim($pee);
    }
}

if (!function_exists('slash_url')) {
    /**
     * Generate an absolute URL with a mandatory trailing slash matching sdinternational.com 1:1,
     * while preserving static file URLs (images, documents, etc.).
     */
    function slash_url(string $path = ''): string
    {
        $trimmed = trim($path);
        if ($trimmed === '' || $trimmed === '/') {
            return rtrim(url('/'), '/') . '/';
        }
        $full = url($trimmed);
        $urlPath = parse_url($full, PHP_URL_PATH) ?? '';
        if (preg_match('/\.[a-zA-Z0-9]{2,5}$/', $urlPath)) {
            return $full;
        }
        return rtrim($full, '/') . '/';
    }
}


