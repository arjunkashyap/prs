<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JSS Mahavidyapeetha</title>
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/indexstyle.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
</head>

<body>
<div class="page">
	<div class="header">
		<img src="images/jss_logo.png" alt="JSS Logo" class="logo"/>
		<div class="gov">
			<p>ಪ್ರಸಾದ</p>
			<p>ಜಗದ್ಗುರು ಶ್ರೀ ಶಿವರಾತ್ರೀಶ್ವರ ಮಹಾವಿದ್ಯಾಪೀಠ</p>
		</div>
	</div>
	<div class="mainpage">
		<div id="archive_nav">
			<ul>
				<li><a href="volumes.php"><img src="images/volumes_icon.png" />ಸಂಪುಟಗಳು</a></li>
				<li><a href="articles.php"><img src="images/articles_icon.png" />ಲೇಖನಗಳು</a></li>
				<li><a href="authors.php"><img src="images/authors_icon.png" />ಲೇಖಕರು</a></li>
			</ul>
		</div>
		<div class="widget11">
			<div class="col1 colL largeSpace">
				<div class="section right" id="sec11">&nbsp;</div>
			</div>
			<div class="col2 largeSpace">
				<h2>ಸಂಪುಟಗಳು</h2>
				<div class="archive_holder">
					<ul>
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query = "select distinct year from article order by year";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

for($i=1;$i<=$num_rows;$i++)
{
	$row=mysql_fetch_assoc($result);
	$year=$row['year'];
	
	$query1 = "select distinct volume from article where year='$year' order by volume";
	$result1 = mysql_query($query1);

	$num_rows1 = mysql_num_rows($result1);

	$vd = '';
	for($i1=1;$i1<=$num_rows1;$i1++)
	{
		$row1=mysql_fetch_assoc($result1);
		$volume=intval($row1['volume']);
		if($volume != 0)
		{
			$vd = $vd . "," . $volume;
		}
	}

	$vd = preg_replace("/^,/", "", $vd);
	
	echo "<li class=\"volspan\"><a href=\"issue.php?year=$year&vd=$vd\">$year<br /><span class=\"sml\">(ಸಂಪುಟ $vd)</span></a></li>";
}
?>									
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer">
	<div class="footer_inside">
		<p>
			JSS Mahavidyapeetha<br />
			Dr. Shivarathri Rajendra Circle, Mysore - 570 004, Karnataka, INDIA<br />
			Phone: +91 821 2548212; Fax: +91 821 2548218<br />
			&copy; 2013, JSS Mahavidyapeetha
		</p>
	</div>
</div>
</body>

</html>
