<?php
function bluagent_config_page() {
  if (function_exists('add_options_page')) {
    add_options_page('Bluagent Menu Title','Bluagent Option', 8, basename(__FILE__), 'bluagent_config');
  }
}
function bluagent_config() {
	// Update url
	if(isset($_POST['activateStop'])) {
		$escape_stop = mysql_real_escape_string($_POST['stop']); // Mysql controll
		update_option("bluagent_stop_url", $escape_stop);
	}
	// Update Advanded Option
	$url = plugins_url("bluagent-block-user-agent");
	//$url = plugins_url("trunk");
	echo("<link rel='stylesheet' type='text/css' href='".$url."/style/bluagent_admin_panel.css'/>");
	if(isset($_POST['activateAdvanced'])) {
	$words = strtolower($_POST['words']);
	$escape_words = mysql_real_escape_string($words); // Mysql controll
	update_option("bluagent", $escape_words);
	}
	// Update Sample Option
	if(isset($_POST['activateSample'])) {
	foreach ($_POST['sample'] as $value) $words = $words . strtolower($value) .",";
	$escape_words = mysql_real_escape_string($words); // Mysql controll
	update_option("bluagent", $escape_words);
	}
	$blocked = get_option("bluagent_counter");
	$stopPage = get_option("bluagent_stop_url");
	$option = get_option('bluagent');
	$this_url = $_SERVER["REQUEST_URI"];
	?>
	<script type="text/javascript">
	// Javascript ShowAndHide
	function ShowAndHide(id1,id2) {
		if(document.getElementById) {
			el1=document.getElementById(id1);
			el2=document.getElementById(id2);
			if(el1.style.display=="none") {
				el1.style.display="block";
				el2.style.display="none";
			} else {
				el1.style.display="none";
				el2.style.display="block";
				}
		}
	}
	</script>
	<div id="content">
	<h1><img src="<?php echo($url . '/img/panel_icon.png'); ?>" alt="panel_icon"/> Bluagent options</h1>
		<div id="sample">
			<a href="#" onclick="ShowAndHide('advanced', 'sample');return(false)">View advanced options</a>
			<?php
			/*** Checked controll ***/
			$selected = array("mac","windows","linux","android","msie");
			$options = explode(",",$option);
			//print_r($options);
			$tot_opt = count($options);
			$ind_opt = 0;
			$ind_sel = 0;
			if($selected[$ind_sel] == $options[$ind_opt]) {
				$selected[0] = 'checked="checked"';
				$ind_opt = 5;
			}
			$ind_sel++;
			for($i=0; $i <= $tot_opt+1; $i++) {
				if($selected[$ind_sel] == $options[$ind_opt]) {
					$selected[$ind_sel] = 'checked="checked"';
					$ind_opt++;
				}
				$ind_sel++;
			}
			/*** Fine checked controll ***/
			?>
			<p>Select what you want to block!</p>
			<form action="" method="post" name="sampleOption">
				<h4>Operating System</h4>
				<p><img src="<?php echo($url . '/img/apple_logo.png'); ?>" alt="apple_logo"/> ALL products Apple
				<input type="checkbox" name="sample[]" value="mac,iphone,ipad,ipod,macintosh" <?php echo($selected[0]); ?>></p>
				<p><img src="<?php echo($url . '/img/win_logo.png'); ?>" alt="win_logo"/> Windows
				<input type="checkbox" name="sample[]" value="Windows" <?php echo($selected[1]); ?>></p>
				<p><img src="<?php echo($url . '/img/tux.png'); ?>" alt="tux"/> Linux AND Linux Based (Example: Android, Ubuntu...)
				<input type="checkbox" name="sample[]" value="Linux" <?php echo($selected[2]); ?>></p>
				<p><img src="<?php echo($url . '/img/android_logo.png'); ?>" alt="android_logo"/> Android
				<input type="checkbox" name="sample[]" value="Android" <?php echo($selected[3]); ?>></p><br/>
				<h4>Browser Web</h4>
				<p><img src="<?php echo($url . '/img/ie.png'); ?>" alt="ie_logo"/> Internet Explorer
				<input type="checkbox" name="sample[]" value="MSIE" <?php echo($selected[4]); ?>></p>
				<input type="submit" name="activateSample" value="Save Changes"><br/>
			</form>
		</div>
		<div id="advanced">
		<a href="#" onclick="ShowAndHide('advanced', 'sample');return(false)">View sample options</a>
		<p>Enter here the words that should not be contained in a User Agent!!!</p>
		<p>Example:</p>
		<p>If you insert <strong>"mac,iphone,ipad,ipod,macintosh"</strong> ALL products Apple do not enter!</p>
		<h3>Syntax:</h3>
		<p>word1,word2,word3...</p>
		<form action="" method="post" name="fwords">
			<input type="text" name="words" value="<?php echo($option); ?>"><br/><br/>
			<input type="submit" name="activateAdvanced" value="Save Changes">
		</form>
		</div>
		<div id="stop">
		<p><strong>Insert your stop page url:</strong></p>
		<form action="" method="post" name="fstop">
			<input type="text" size="60" name="stop" value="<?php echo($stopPage); ?>"><br/><br/>
			<input type="submit" name="activateStop" value="Save Changes">
		</form>
		</div>
		<div id="info">
		<?php if (isset($_REQUEST['history'])) {
				$clean_url = explode("&", $this_url); ?>
				<p><strong><a href="<?php echo($clean_url[0]); ?>"><?php echo($blocked); ?> users have been blocked!</a></strong></p>
		<?php $history = get_option("bluagent_history");
			$history_explode = explode("%!%", $history);
			$tot_history = count($history_explode);
			echo("<ul>");
			for($i = 0; $i < $tot_history; $i++) echo("<li>" . $history_explode[$i] . "</li>");
			echo("</ul>");
		} else { ?>
			<p><strong><a href="<?php echo($this_url . '&history=true'); ?>"><?php echo($blocked); ?> users have been blocked!</a></strong></p>
		<?php } ?>
		<a href="http://wordpress.org/extend/plugins/bluagent-block-user-agent/">Please rate this plugin!</a>
		</div>
		</div>
<?php } ?>
