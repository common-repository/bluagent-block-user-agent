<?php
function bluagent_install() {
  if(!get_option('bluagent')) {
    add_option('bluagent', '');
  }
  if(!get_option('bluagent_counter')) {
    add_option('bluagent_counter', '0');
  }
  if(!get_option('bluagent_stop_url')) {
  	//$url = plugins_url("trunk");
    $url = plugins_url('bluagent-block-user-agent');
    add_option('bluagent_stop_url', $url . "/stop.php");
  }
  if(!get_option('bluagent_history')) {
    add_option('bluagent_history','');
  }
}
if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
    bluagent_install();
}
?>