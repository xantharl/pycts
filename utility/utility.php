<?php
/*
This file is part of PYCTS, the PY151 Credit Tracking System.

PYCTS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

PYCTS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with PYCTS.  If not, see <http://www.gnu.org/licenses/>.

PYCTS and this file are Copyright 2011 by Mark Platek.
*/


/* check for unauthenticated access */
if( !isset($_SESSION['active']) ) {
	exit;
}

echo '<div id="utility">';

$sel_roster = $sel_user_management = $sel_stats = $sel_studies  = $sel_backup_restore = $sel_sys_opts = "";
$sel = 'class="selected"';
if( isset($_GET['user_management']) )
	$sel_user_management = $sel;
else if( isset($_GET['statistics']) )
	$sel_stats = $sel;
else if( isset($_GET['studies']) )
	$sel_studies = $sel;
else if( isset($_GET['backup_restore']) )
	$sel_backup_restore = $sel;
else if( isset($_GET['system_options']) )
	$sel_sys_opts = $sel;
else
	$sel_roster = $sel;

/* print navigation */
echo '<form class="search" id="search" method="get" action="user.php">';
echo '<ul>';
echo '<li><a ' . $sel_roster . ' href="user.php">Roster</a></li>';
if( $_SESSION['role'] == 0 || $_SESSION['role'] == 1 )
	echo '<li><a ' . $sel_stats . ' href="user.php?statistics">Statistics</a></li>';
if( $_SESSION['role'] == 0 )
	echo '<li><a ' . $sel_studies . ' href="user.php?studies">Studies</a></li>';
if( $_SESSION['role'] == 0 )
        echo '<li><a ' . $sel_user_management . ' href="user.php?user_management">User Management</a></li>';
if( $_SESSION['role'] == 0 )
	echo '<li><a ' . $sel_backup_restore . ' href="user.php?backup_restore">Database Management</a></li>';
if( $_SESSION['role'] == 0 )
	echo '<li><a ' . $sel_sys_opts . ' href="user.php?system_options">System Options</a></li>';
echo <<<EOF
<li class="search">
	<select class="search" name="filter_element" onchange="clearfill(); this.form.submit()">
		<option>Search by...</option>
		<option>All Fields</option>
		<option>Last Name</option>
		<option>First Name</option>
		<option>AD Username</option>
		<option>Professor</option>
	</select>
</li>
<li class="search">
EOF;

if( $_SESSION['filter'] != "" )
	echo '<input class="search" type="text" name="filter" value="' . $_GET['filter'] . '"/>';
else
	echo '<input class="search" id="searchbox" type="text" name="filter" onclick="clearfill()" onblur="prefill()"/>';

echo <<<EOF
</li>
</ul>
</form>
EOF;

echo '</div> <!-- closing div "utility" -->';

?>
