<?php
/*
 Plugin Name: Bluagent - Block User Agent
 Plugin URI: http://www.alexfranco90.altervista.org/bluagent
 Description: Block Custom User Agent
 Version: 0.3
 Author: Alex Franco
 Author URI: http://www.alexfranco90.altervista.org
*/

/* Copyright 2005 Alex Franco (email: alex.franco.1990@gmail.com)
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/
?>
<?php
plugin_dir_url( __FILE__ );
include_once dirname( __FILE__ ) . "/functions_controll.php";
include_once dirname( __FILE__ ) . "/admin_panel.php";
include_once dirname( __FILE__ ) . "/bluagent_install.php";
if (!isset($_SESSION['ua'])) {
	add_action ('init', 'bluagent_controll');
	add_action ('init', 'bluagent_controll_flag');
} else {
	add_action ('init', 'bluagent_controll_flag');
	}
add_action('admin_menu', 'bluagent_install');
add_action('admin_menu', 'bluagent_config_page');
?>