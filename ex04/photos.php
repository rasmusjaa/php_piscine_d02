#!/usr/bin/php
<?PHP

function scheme($url)
{
	$result = parse_url($url);
	if (isset($result['scheme']))
		return $result['scheme'].":";
	else
		return "http:";
}

function url($url)
{
	$result = parse_url($url);
	if (isset($result['scheme']))
		return $result['scheme']."://".$result['host'];
	else
		return "http://".$result['host'];
}

function baseurl($url)
{
	$result = parse_url($url);
	return $result['host'];
}

if ($argc == 2)
{
	$ch = curl_init($argv[1]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$content = curl_exec($ch);
	if (!is_string($content) || !strlen($content))
		exit("Can't connect to url $argv[1] or it oesn't exist\n");
	curl_close($ch);

	$pattern = '/<[iI][mM][gG][^>]+?[sS][rR][cC]=["\'](.*?\.(png|jpg|jpeg|gif|webp|heic|svg))["\'\?]/';
	preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

	foreach ($matches as $val)
	{
		if ($val[1])
		{
			$val[1] = trim($val[1]);
			$url = url($argv[1]);
			$baseurl = baseurl($argv[1]);
			if (substr_compare($val[1], "//", 0, 2) === 0)
				$line = scheme(substr($val[1], 2)) . $val[1];
			else if (substr_compare($val[1], "/", 0, 1) === 0)
				$line = $url . $val[1];
			else if (substr_compare($val[1], "http", 0, 4) === 0)
				$line = $val[1];
			else
				$line = $url . "/" . $val[1];

			$file = basename($line);
			$save = "./" . $baseurl . "/" . $file;

			if (!file_exists("./" . $baseurl))
				mkdir("./" . $baseurl, 0755);

			error_reporting(0);
			if (!file_exists("./" . $save))
			{
				if(!file_put_contents($save, file_get_contents($line)))
				{
					echo "Download from $line and save to $save failed.\n";
				}
			}
		}
	}
}
?>
