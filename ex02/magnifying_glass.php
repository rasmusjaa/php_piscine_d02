#!/usr/bin/php
<?PHP

function upper($matches)
{
	return (str_replace($matches[1], strtoupper($matches[1]), $matches[0]));
}

function upper2($matches)
{
	$pattern = '/title="((.|\n)*?)"/';
	$matches[0] = preg_replace_callback($pattern, 'upper', $matches[0]);
	$pattern = '/>((.|\n)*?)</';
	$matches[0] = preg_replace_callback($pattern, 'upper', $matches[0]);
	return $matches[0];
}

if ($argc == 2 && file_exists($argv[1]))
{
	$line = file_get_contents($argv[1]);
	$pattern = '/<a(.|\n)*?<\/a>/';
	$line = preg_replace_callback($pattern, 'upper2', $line);
	echo $line;
}
?>
