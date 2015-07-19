<?php

$ssb_config = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize();

if(isset($ssb_config['counter'])) {
    include PLUGIN . DS . File::B(__DIR__) . DS . 'workers' . DS . 'counter.php';
}

$ssb_button = include PLUGIN . DS . File::B(__DIR__) . DS . 'workers' . DS . 'button.php';

// Create the widget
Widget::add('shareButtons', function() use($config, $ssb_config, $ssb_button) {
    if($article = Config::get('article')) {
        $url = $article->url;
        $title = $article->title;
        $description = $article->description;
        $image = $article->image;
    } else if($page = Config::get('page')) {
        $url = $page->url;
        $title = $page->title;
        $description = $page->description;
        $image = $page->image;
    } else {
        $url = $config->url_current;
        $title = $config->page_title;
        $description = $config->description;
        $image = $config->url . '/favicon.ico';
    }
    Session::set('cookie:share_button_cargo', array($url, $title, $description, $image));
    $html = '<span class="share-button-group">';
    foreach($ssb_button as $key => $value) {
        $the_count = isset($ssb_config['counter']) ? ' <b>' . (isset($value['counter']) && function_exists($value['counter']) ? call_user_func($value['counter'], $url) : 0) . '</b>' : "";
        $html .= '<a class="share-button share-button-' . $key . '" href="' . $config->url . '/share/to:' . $key . '"' . (Asset::loaded($config->protocol . ICON_LIBRARY_PATH) && isset($value['icon']) ? ' data-icon="' . $value['icon'] . '"' : "") . '><span>' . $value['title'] . '</span>' . $the_count . '</a> ';
    }
    return trim($html) . '</span>';
});

// Inject the CSS
Weapon::add('shell_after', function() {
    echo Asset::stylesheet('cabinet/plugins/' . File::B(__DIR__) . '/assets/shell/skin.min.css');
});

// Inject the widget to article footer
if($config->page_type === 'article' && isset($ssb_config['inject'])) {
    Weapon::add('article_footer', function() {
        echo O_BEGIN . '<div class="share-button-group-outer">' . Widget::shareButtons() . '</div>' . O_END;
    });
}

// Inject the widget to page footer
if($config->page_type === 'page' && isset($ssb_config['inject'])) {
    Weapon::add('page_footer', function() {
        echo O_BEGIN . '<div class="share-button-group-outer">' . Widget::shareButtons() . '</div>' . O_END;
    });
}


/**
 * Redirect to Sharing URL
 * -----------------------
 */

Route::accept('share/to:(:any)', function($kind = "") use($config, $ssb_button) {
    if( ! isset($ssb_button[$kind])) {
        Shield::abort();
    }
    $param = Session::get('cookie:share_button_cargo', array($config->url, $config->title, $config->slogan, $config->url . '/favicon.ico'));
    Guardian::kick(sprintf($ssb_button[$kind]['url'], urlencode($param[0]), urlencode(strip_tags($param[1])), urlencode(strip_tags($param[2])), urlencode($param[3])));
});