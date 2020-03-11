#!/usr/bin/php
<?PHP
if ($argc > 1)
{
	$arr = explode(" ", $argv[1]);
	if (count($arr) != 5)
		exit("Wrong Format");

	$pattern = "/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)$/";
	if (!preg_match($pattern, $arr[0]))
		exit("Wrong Format");
	array_shift($arr);

	$pattern = "/^([0-3]?[0-9])$/";
	if (!preg_match($pattern, $arr[0]) || $arr[0] > 31)
		exit("Wrong Format");

	if (preg_match("/^([Jj]anvier)$/", $arr[1]))
		$arr[1] = "January";
	else if (preg_match("/^([Ff]évrier)$/", $arr[1]))
		$arr[1] = "February";
	else if (preg_match("/^([Ff]evrier)$/", $arr[1]))
		$arr[1] = "February";
	else if (preg_match("/^([Mm]ars)$/", $arr[1]))
		$arr[1] = "March";
	else if (preg_match("/^([Aa]vril)$/", $arr[1]))
		$arr[1] = "April";
	else if (preg_match("/^([Mm]ai)$/", $arr[1]))
		$arr[1] = "May";
	else if (preg_match("/^([Jj]uin)$/", $arr[1]))
		$arr[1] = "June";
	else if (preg_match("/^([Jj]uillet)$/", $arr[1]))
		$arr[1] = "July";
	else if (preg_match("/^([Aa]oût)$/", $arr[1]))
		$arr[1] = "August";
	else if (preg_match("/^([Aa]out)$/", $arr[1]))
		$arr[1] = "August";
	else if (preg_match("/^([Ss]eptembre)$/", $arr[1]))
		$arr[1] = "September";
	else if (preg_match("/^([Oo]ctobre)$/", $arr[1]))
		$arr[1] = "October";
	else if (preg_match("/^([Nn]ovember)$/", $arr[1]))
		$arr[1] = "November";
	else if (preg_match("/^([Nn]ovembre)$/", $arr[1]))
		$arr[1] = "November";
	else if (preg_match("/^([Dd]écembre)$/", $arr[1]))
		$arr[1] = "December";
	else if (preg_match("/^([Dd]ecembre)$/", $arr[1]))
		$arr[1] = "December";
	else
		exit("Wrong Format");

	$pattern = "/^([0-9]{4})$/";
	if (!preg_match($pattern, $arr[2]))
		exit("Wrong Format");

	$pattern = "/^([0-2][0-9].[0-6][0-9].[0-6][0-9])$/";
	if (!preg_match($pattern, $arr[3]))
		exit("Wrong Format");
	$arr[3][2] = ":";
	$arr[3][5] = ":";

	$line = implode(" ", $arr);
	echo(strtotime($line));
}
?>
