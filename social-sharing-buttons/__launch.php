<?php


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . basename(__DIR__) . '/update', function() use($config, $speak) {
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        $root = PLUGIN . DS . basename(__DIR__) . DS . 'shell';
        $core = File::open($root . DS . '__base.css')->read();
        $core_skin = File::open($root . DS . 'pigment' . DS . $request['skin'] . '.css')->read();
        File::write(Converter::detractShell($core . $core_skin))->saveTo($root . DS . 'skin.min.css');
        unset($request['token']);
        File::serialize($request)->saveTo(PLUGIN . DS . basename(__DIR__) . DS . 'states' . DS . 'config.txt', 0600);
        Notify::success(Config::speak('notify_success_updated', $speak->plugin));
        Guardian::kick(dirname($config->url_current));
    }
});