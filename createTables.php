<?php
//use include(createTables.php); to utilize the functions i think.
function createWriter()
{
	$names = array('Alvin', 'Derek', 'Lewis', 'Trevor', 'Kyle', 'Thomas', 'Chris', 'Kevin', 'Kobe', 'David');
	echo "<div class = \"statusbox\"> <table border=\"1\"> <tr><td>User</td><td>Submit Time</td><td>Tweet</td><td>Status</td><td>Delete Tweet</td></tr><br>";
	for ($i = 0; $i < count($names); $i++)
	{
		$date = getdate();
		echo "<tr><td>$names[$i] </td><td>$date[hours]:$date[minutes] $date[mon] $date[mday], $date[year]</td><td>this is the message</td><td>Pending</td><td> [] </td></tr><br>";
	}
	echo "</table></div>";
}

function createPublisher()
{
	$names = array('Alvin', 'Derek', 'Lewis', 'Trevor', 'Kyle', 'Thomas', 'Chris', 'Kevin', 'Kobe', 'David');
	echo "<div class = \"statusbox\"> <table border=\"1\"> <tr><td>User</td><td>Submit Time</td><td>Tweet</td><td>Status</td><td>Approve/Reject</td><td>Delete Tweet</td><td>Notes</td></tr><br>";
	for ($i = 0; $i < count($names); $i++)
	{
		$date = getdate();
		echo "<tr><td> $names[$i] </td><td>$date[hours]:$date[minutes] $date[mon] $date[mday], $date[year] </td><td>this is the message</td><td>Pending</td><td>approve/reject</td><td>[]</td><td>notes publisher put</td></tr><br>";
	}
	echo "</table></div>";
}
?>

