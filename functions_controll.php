<?php
function bluagent_controll() {
	if(get_option("bluagent") != FALSE) {
		$options = get_option("bluagent");
		$counter = get_option("bluagent_counter");
		$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$controll = explode(",", $options);
		foreach ($controll as $value) {
			$ua = strpos($userAgent, $value);
			if ($ua !== FALSE) break;
		}
		if ($ua === FALSE) {
			$_SESSION['ua'] = FALSE;
		} else {
			$_SESSION['ua'] = TRUE;
			$counter++;
			update_option("bluagent_counter", $counter);
			add_history();
		}
	} else {
		$_SESSION['ua'] = FALSE;
	}
}
function bluagent_controll_flag() {
	if($_SESSION['ua'] == TRUE) {
		$url = get_option("bluagent_stop_url");
    	header("Location: " . $url);
    	exit;
    }
}
function add_history() {
	$history = get_option('bluagent_history');
	$history_array = explode("%!%", $history);
	if(count($history_array) > 1000 || $history == "") {
		update_option("bluagent_history", $_SERVER['HTTP_USER_AGENT']);
	} else {
		update_option("bluagent_history", $history . "%!%" . $_SERVER['HTTP_USER_AGENT']);
	}
}
?>