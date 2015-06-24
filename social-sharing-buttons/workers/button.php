<?php

// %1$s: URL
// %2$s: Title
// %3$s: Description
// %4$s: Image

return array(
    'facebook' => array(
        'title' => 'Facebook',
        'url' => 'https://www.facebook.com/sharer/sharer.php?u=%1$s',
        'icon' => '&#xf09a;',
        'counter' => 'ssb_facebook_share'
    ),
    'twitter' => array(
        'title' => 'Twitter',
        'url' => 'https://twitter.com/intent/tweet?text=%3$s&amp;url=%1$s',
        'icon' => '&#xf099;',
        'counter' => 'ssb_twitter_share'
    ),
    'google-plus' => array(
        'title' => 'Google+',
        'url' => 'https://plus.google.com/share?url=%1$s',
        'icon' => '&#xf0d5;',
        'counter' => 'ssb_google_plus'
    ),
    'pinterest' => array(
        'title' => 'Pinterest',
        'url' => 'https://www.pinterest.com/pin/create/button?url=%1$s&amp;description=%3$s',
        'icon' => '&#xf231;',
        'counter' => 'ssb_pinterest_share'
    ),
    'linkedin' => array(
        'title' => 'LinkedIn',
        'url' => 'http://www.linkedin.com/shareArticle?mini=true&amp;url=%1$s&amp;title=%2$s&amp;summary=%3$s&amp;source=%1$s',
        'icon' => '&#xf0e1;',
        'counter' => 'ssb_linkedin_share'
    )
);