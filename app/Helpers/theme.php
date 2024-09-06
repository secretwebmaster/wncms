<?php

//Theme
if (!function_exists('wncms_get_theme_option')) {
    function wncms_get_theme_option($key, $fallback = '')
    {
        $cacheKey = 'theme_options' . wncms()->getDomain();
        $cacheTags = ['websites', 'pages'];
        $cacheTime = gss('data_cache_time', 3600);
        // wncms()->cache()->clear($cacheKey, $cacheTags);

        $theme_options = wncms()->cache()->tags($cacheTags)->remember($cacheKey, $cacheTime, function () {
            $website = wn('website')->get();
            if (!$website) return;
            return  $website->get_options();
        });
        
        return array_key_exists($key, $theme_options) ? $theme_options[$key] : $fallback;
    }
}