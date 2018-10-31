<!DOCTYPE html>

<head>
<title>Jitesh Singla MD5</title>
</head>

<body>

<h1>MD5 Maker</h1>

<h2>
This application takes an MD5 hash of a four digit pin and check all 10,000 possible four digit PINs to determine the PIN.</h2>
<h3>Debug Output:</h3>
<?php

$md5 = "Not computed";

$count=0;
$time_pre = microtime(true);
if ( isset($_GET['encode']) )
 {
    $md5 = hash('md5', $_GET['encode']);
	for($i=0;$i<=9;$i++)
	{
		for($j=0;$j<=9;$j++)
		{
			for($k=0;$k<=9;$k++)
			{
				for($l=0;$l<=9;$l++)
				{
					$count++;$s = "$i"."$j"."$k"."$l";
					$hash = hash('md5',$s);
					if($i==8 && $j==8 && $k==8)
					{print($hash);
					print(" ");print($s);
					echo "<br>";}
					if ($hash == $_GET['encode'])	
					{
					print("Total checks: ");
					print($count);
					echo "<br>";
					$i=10;$j=10;$k=10;$l=10;
					print("PIN: ");print($s);
					break;
					}
					
	}	}	}	}

$time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";

if($count==10000)
{
print("Total checks: ");
print($count);
echo "<br>";
print("PIN: Not Found");

}}
?>





<form>

<input type="text" name="encode" size="40" />

<input type="submit" value="Compute MD5"/>

</form>

<p><a href="index.php">Reset this page</a></p>

<p><a href="md5.php">Make an MD5 PIN</a></p>

<p><a href="md5.php">MD5 Encoder</a></p>
<p><a href="https://www.wa4e.com/assn/crack/">Specification for this assignment</a></p>
<p><a href="https://github.com/csev/wa4e/tree/master/code/crack">Source code similar to this application</a></p>

</body>

</html>
