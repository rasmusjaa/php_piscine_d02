#!/usr/bin/php
<?PHP

date_default_timezone_set("Europe/Helsinki");

if (file_exists("/var/run/utmpx"))
{
	$fd = fopen("/var/run/utmpx", "r");
	while ($utmpx = fread($fd, 628)) {
		$user = unpack("a256user/a4id/a32line/ipid/itype/i2time", $utmpx);
		if (strcmp($user['type'], "7") == 0)
			$users[] = $user;
	}

	$userlen = 9;
	$linelen = 9;
	foreach ($users as $user) {
		foreach ($user as $key => $value)
		{
			$copy = $value;
			if($key === "user")
				if (strlen(trim($copy)) >= $userlen)
					$userlen = strlen(trim($copy)) + 1;
			if($key === "line")
				if (strlen(trim($copy)) >= $linelen)
					$linelen = strlen(trim($copy)) + 1;
		}
	}

	foreach ($users as $user) {
		foreach ($user as $key => $value)
		{
			if ($key === "user")
				echo str_pad(trim($value), $userlen);
			if ($key === "line")
				echo str_pad(trim($value), $linelen);
			if ($key === "time1")
				echo date("M j H:i", $value)."\n";
		}
	}
}
?>
