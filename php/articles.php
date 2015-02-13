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
			<p><a href="../index.php">ಪ್ರಸಾದ</a></p>
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
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_query("set names utf8");

$month_name = array("1"=>"ಜನವರಿ","2"=>"ಫೆಬ್ರವರಿ","3"=>"ಮಾರ್ಚ್","4"=>"ಏಪ್ರಿಲ್","5"=>"ಮೇ","6"=>"ಜೂನ್","7"=>"ಜುಲೈ","8"=>"ಆಗಸ್ಟ್‍","9"=>"ಸೆಪ್ಟೆಂಬರ್","10"=>"ಅಕ್ಟೋಬರ್","11"=>"ನವೆಂಬರ್","12"=>"ಡಿಸೆಂಬರ್");

echo "<div class=\"col2 largeSpace\">
<h2>ಲೇಖನಗಳು</h2>
<div class=\"archive_holder\">
<ul>
";

$query = "select * from article order by TRIM(LEADING '&#8220;' FROM title)";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

for($i=1;$i<=$num_rows;$i++)
{
	$row=mysql_fetch_assoc($result);
	
	$title=$row['title'];
	$authid=$row['authid'];
	$authorname=$row['authorname'];
	$page=$row['page'];
	$page_end=$row['page_end'];
	$volume=$row['volume'];
	$issue=$row['issue'];
	$year=$row['year'];
	$month=$row['month'];
	$mname=$row['mname'];
	$titleid=$row['titleid'];
	
	if(preg_match("/\-/", $month))
	{
		$ms = preg_split("/\-/", $month);
		$md = $month_name{intval($ms[0])} . "-" . $month_name{intval($ms[1])};
	}
	else
	{
		$md = $month_name{intval($month)};
	}
	
	if($issue == "00")
	{
		$id = "ವಿಶೇಷ ಸಂಚಿಕೆ";
	}
	else
	{
		$id = "ಸಂಚಿಕೆ " . intval($issue);
	}
	
	echo "\n<li class=\"articlespan\">";
	echo "<span class=\"titlespan\"><a href=\"../Volumes/$year/$month/index.djvu?djvuopts&page=$page.djvu&zoom=page\" target=\"_blank\">$title</a></span><br />";
	if($authorname != '')
	{
		echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$authid&author=$authorname\">$authorname</a></span> ";
	}
	echo "<span class=\"yearspan\"><a href=\"toc.php?year=$year&month=$month\">($md $year)</a></span>";
	echo "</li>";
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
