<?php

// Facebook Shares/Likes
function ssb_facebook($url, $output = 'share') {
    $output = rtrim($output, 's') . 's';
    $count = json_decode(file_get_contents('http://graph.facebook.com/?id=' . $url), true);
    if(isset($count[$output]) && (int) $count[$output] !== 0) {
        return (int) $count[$output];
    }
    return 0;
}

// Facebook Shares
function ssb_facebook_share($url) {
    return ssb_facebook($url, 'share');
}

// Facebook Likes
function ssb_facebook_like($url) {
    return ssb_facebook($url, 'like');
}

// Twitter Shares
function ssb_twitter_share($url) {
    $count = json_decode(file_get_contents('https://cdn.api.twitter.com/1/urls/count.json?url=' . $url), true);
    if(isset($count['count']) && (int) $count['count'] !== 0){
        return (int) $count['count'];
    }
    return 0;
}

// Pinterest Shares
function ssb_pinterest_share($url) {
    $count = file_get_contents('http://api.pinterest.com/v1/urls/count.json?callback%20&url=' . $url);
    $count = json_decode(preg_replace('#^receiveCount\((.*?)\)$#', '$1', $count), true);
     if(isset($count['count']) && (int) $count['count'] !== 0) {
        return (int) $count['count'];
     }
     return 0;
}

// LinkedIn Shares
function ssb_linkedin_share($url) {
    $count = json_decode(file_get_contents('https://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json'), true);
    if(isset($count['count']) && (int) $count['count'] !== 0) {
        return (int) $count['count'];
    }
    return 0;
}

// Google+
function ssb_google_plus($url) {
    if(function_exists('curl_version')) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://clients6.google.com/rpc');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $curl_output = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($curl_output, true);
        return intval($json[0]['result']['metadata']['globalCounts']['count']);
    } else {
        $content = file_get_contents('https://plusone.google.com/u/0/_/+1/fastbutton?url=' . urlencode($_GET['url']) . '&count=true');
        $doc = new DOMdocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($content);
        $doc->saveHTML();
        $count = $doc->getElementById('aggregateCount')->textContent;
        return $count ? intval($count) : 0;
    }
    return 0;
}