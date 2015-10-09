<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <?php echo Form::hidden('token', $token); ?>
  <?php

  $ssb_config = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize();

  $options = array('__' => $speak->none);
  foreach(glob(PLUGIN . DS . File::B(__DIR__) . DS . 'assets' . DS . 'shell' . DS . 'pigment' . DS . '*.css', GLOB_NOSORT) as $skin) {
      $skin = File::N($skin);
      $options[$skin] = ucwords(Text::parse($skin, '->text'));
  }

  ?>
  <div class="grid-group">
    <span class="grid span-1 form-label"></span>
    <span class="grid span-5" title="<?php echo $speak->preview; ?>"><?php echo Widget::shareButtons(); ?></span>
  </div>
  <label class="grid-group">
    <span class="grid span-1 form-label"><?php echo $speak->plugin_ssb_title_skin; ?></span>
    <span class="grid span-5"><?php echo Form::select('skin', $options, $ssb_config['skin']); ?></span>
  </label>
  <div class="grid-group">
    <span class="grid span-1"></span>
    <div class="grid span-5">
      <p>
        <?php echo Form::checkbox('counter', 'true', isset($ssb_config['counter']), $speak->plugin_ssb_title_counter); ?>
        <br>
        <?php echo Form::checkbox('inject', 'true', isset($ssb_config['inject']), $speak->plugin_ssb_title_inject, array('id' => 'toggle-widget-code')); ?>
      </p>
      <div id="widget-code">
        <p><?php echo $speak->plugin_ssb_description_inject; ?></p>
        <pre><code class="php">&lt;?php echo Widget::shareButtons(); ?&gt;</code></pre>
      </div>
    </div>
  </div>
  <div class="grid-group">
    <span class="grid span-1"></span>
    <span class="grid span-5"><?php echo Jot::button('action', $speak->update); ?></span>
  </div>
</form>
<script>
(function(w, d) {
    var check = d.getElementById('toggle-widget-code'),
        source = d.getElementById('widget-code');
    source.style.display = check.checked ? 'none' : 'block';
    check.onchange = function() {
        source.style.display = this.checked ? 'none' : 'block';
    };
})(window, document);
</script>