<?php

function html_header()
{
	header('Content-Type: text/html; charset=iso-8859-1');
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
	echo '<html>';
}

function log_header()
{
	global $channel;

	html_header();
	echo "<head><title>$channel logs</title></head><body>";
}

$log = $_GET['log'];

$exultlogdate = "([123]?\d)(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)(\d\d\d\d)";

function nicedate($d)
{
	global $exultlogdate;
	if (preg_match("/^$exultlogdate$/", $d, $elms)) {
		$nd = $elms[1].' '.$elms[2].' '.$elms[3];
	} else {
		$nd = '';
	}

	return $nd;
}

$mnr['Jan'] = 1;
$mnr['Feb'] = 2;
$mnr['Mar'] = 3;
$mnr['Apr'] = 4;
$mnr['May'] = 5;
$mnr['Jun'] = 6;
$mnr['Jul'] = 7;
$mnr['Aug'] = 8;
$mnr['Sep'] = 9;
$mnr['Oct'] = 10;
$mnr['Nov'] = 11;
$mnr['Dec'] = 12;

$month = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

function prevday($d)
{
	global $mnr, $month, $exultlogdate;
	global $startyear;
	$monthdays = [1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

	preg_match("/^$exultlogdate$/", $d, $elms);
	$day = (int) $elms[1];
	$monthnr = $mnr[(string) $elms[2]];
	$year = (int) $elms[3];

	if (0 == $year % 4 && (0 != $year % 100 || 0 == $year % 400)) {
		++$monthdays[2];
	}

	--$day;
	if ($day <= 0) {
		--$monthnr;
		if ($monthnr <= 0) {
			--$year;
			$monthnr = 12;
		}

		$day = $monthdays[$monthnr];
	}

	if ($year < $startyear) {
		return '';
	}

	return $day.$month[$monthnr].$year;
}

function nextday($d)
{
	global $mnr, $month, $exultlogdate;
	$monthdays = [1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

	preg_match("/^$exultlogdate$/", $d, $elms);
	$day = (int) $elms[1];
	$monthnr = $mnr[(string) $elms[2]];
	$year = (int) $elms[3];

	if (0 == $year % 4 && (0 != $year % 100 || 0 == $year % 400)) {
		++$monthdays[2];
	}

	++$day;
	if ($day > $monthdays[$monthnr]) {
		$day = 1;
		++$monthnr;
		if ($monthnr > 12) {
			++$year;
			$monthnr = 1;
		}
	}

	if ($year > gmdate('Y')) {
		return '';
	}

	return $day.$month[$monthnr].$year;
}

function datenr($d)
{
	global $exultlogdate;
	global $mnr;

	preg_match("/^$exultlogdate$/", $d, $elms);
	$day = (int) $elms[1];
	$month = $mnr[(string) $elms[2]];
	$year = (int) $elms[3];

	return ($year * 500) + ($month * 40) + $day + 1000;
}

function log_display()
{
	global $exultlogdate, $month;
	global $log;
	global $startyear, $channel, $script, $name, $homepage, $logdir, $verbose;

	$logdate = '';

	if ($log && preg_match("/^$exultlogdate$/", $log)) {
		$logdate = $log;
	} elseif ('toc' == $log) {
		echo "<h2>$channel logs: $verbose archive</h2>";
		echo "<p><a href=\"$script\">Today</a><br/></p>";
		echo "<a href=\"$homepage\">$name homepage</a><br/>";
		$handle = opendir($logdir);
		if (is_dir($logdir) && $handle) {
			$logdates = [];
			while ($entry = readdir($handle)) {
				if (preg_match("/^{$channel}_($exultlogdate)\.log$/", $entry, $elms)) {
					$logdates[$elms[1]] = datenr($elms[1]);
				}
			}
			closedir($handle);

			$curmonth = 'xyz';
			$loc = 5;

			echo '<table border="0"><tr><td>';
			arsort($logdates);
			reset($logdates);
			foreach ($logdates as $entry => $d) {
				preg_match("/^$exultlogdate$/", $entry, $elms);
				$thismonth = $elms[2].$elms[3];
				if ($thismonth != $curmonth) {
					$loc = $loc + 1;
					if (6 == $loc) {
						$loc = 0;
					}
					if (!$loc) {
						echo '<br></td></tr><tr><td valign="top" width="150">';
					} else {
						echo '<br></td><td valign="top" width="150">';
					}
					echo '<h3>'.$elms[2].' '.$elms[3].'</h3>';
					$curmonth = $thismonth;
				}
				$ndate = nicedate($entry);
				echo "<a href=\"$script?log=$entry\">$ndate</a><br/>";
			} while (next($logdates)) {
			}
			echo '<br/></td></tr></table>';
		}

		return;
	} else {
		$logdate = gmdate('j').$month[(int) gmdate('m')].'20'.gmdate('y');
	}

	if ($ndate = nicedate($logdate)) {
		$yesterday = prevday($logdate);
		$tomorrow = nextday($logdate);

		echo "<h2>$channel $verbose logs for $ndate (GMT)</h2>";

		$fn = "$logdir/{$channel}_$logdate.log";

		echo "<a href=\"$script?log=toc\">Archive</a> ";
		echo "<a href=\"$script\">Today</a> ";
		if ($yesterday) {
			echo "<a href=\"$script?log=$yesterday\">Yesterday</a> ";
		}
		if ($tomorrow) {
			echo "<a href=\"$script?log=$tomorrow\">Tomorrow</a>";
		}
		echo '<br/>';
		echo "<a href=\"$homepage\">$name homepage</a><br/>";

		echo '<hr><br>';

		if (file_exists($fn)) {
			include "$logdir/{$channel}_$logdate.log";
		} else {
			echo "Sorry, logs for $ndate are not available.<br/>";
		}
	}

	echo '</body></html>';
}
