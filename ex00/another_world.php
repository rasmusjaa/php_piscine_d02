#!/usr/bin/php
<?PHP
if ($argc > 1)
{
	$stripped = preg_replace('/( |\t)+/', ' ', $argv[1]);
	$stripped = trim($stripped);
	echo "$stripped\n";
}
?>
