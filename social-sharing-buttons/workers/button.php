<?php

// %1$s: URL
// %2$s: Title
// %3$s: Description
// %4$s: Image

return array(
    'facebook' => array(
        'title' => 'Facebook',
        'url' => 'https://www.facebook.com/sharer/sharer.php?u=%1$s',
        'icon' => 'fa fa-facebook',
        'counter' => 'ssb_facebook_share'
    ),
    'twitter' => array(
        'title' => 'Twitter',
        'url' => 'https://twitter.com/intent/tweet?text=%3$s&url=%1$s',
        'icon' => 'fa fa-twitter',
        'counter' => 'ssb_twitter_share'
    ),
    'google-plus' => array(
        'title' => 'Google+',
        'url' => 'https://plusone.google.com/_/+1/confirm?url=%1$s&title=%2$s',
        'icon' => 'fa fa-google-plus',
        'counter' => 'ssb_google_plus'
    ),
    'pinterest' => array(
        'title' => 'Pinterest',
        'url' => 'https://www.pinterest.com/pin/create/button?url=%1$s&description=%3$s',
        'icon' => 'fa fa-pinterest',
        'counter' => 'ssb_pinterest_share'
    ),
    'linkedin' => array(
        'title' => 'LinkedIn',
        'url' => 'http://www.linkedin.com/shareArticle?mini=true&url=%1$s&title=%2$s&summary=%3$s&source=%1$s',
        'icon' => 'fa fa-linkedin',
        'counter' => 'ssb_linkedin_share'
    )
);