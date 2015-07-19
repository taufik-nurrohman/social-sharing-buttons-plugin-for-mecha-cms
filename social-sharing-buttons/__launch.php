<?php


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . File::B(__DIR__) . '/update', function() use($config, $speak) {
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        $root = PLUGIN . DS . File::B(__DIR__) . DS . 'assets' . DS . 'shell';
        $core = File::open($root . DS . '__base.css')->read();
        $core_skin = File::open($root . DS . 'pigment' . DS . $request['skin'] . '.css')->read();
        File::write(Converter::detractShell($core . $core_skin))->saveTo($root . DS . 'skin.min.css');
        unset($request['token']);
        File::serialize($request)->saveTo(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt', 0600);
        Notify::success(Config::speak('notify_success_updated', $speak->plugin));
        Guardian::kick(File::D($config->url_current));
    }
});


// Remove cache on plugin destruct ...
Weapon::add('on_plugin_' . md5(File::B(__DIR__)) . '_destruct', function() {
    File::open(CACHE . DS . 'plugin-' . File::B(__DIR__))->delete();
});