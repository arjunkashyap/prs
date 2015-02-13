#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"<:utf8","prs.xml") or die "can't open prs.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

#vnum, number, month, year, title, feature, authid, page, 

$sth11=$dbh->prepare("CREATE TABLE article(title varchar(500), 
authid varchar(200), 
authorname varchar(1000), 
page varchar(5), 
page_end varchar(5),
volume varchar(10),
issue varchar(10),
year varchar(10), 
month varchar(10),
mname varchar(500),
titleid int(6) auto_increment, primary key(titleid)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

$authids = "";
$author_name = "";

while($line)
{
	if($line =~ /<issue year="(.*)" month="(.*)" mname="(.*)" vnum="(.*)" inum="(.*)">/)
	{
		$year = $1;
		$month = $2;
		$mname = $3;
		$volume = $4;
		$issue = $5;
	}	
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}	
	elsif($line =~ /<author>(.*)<\/author>/)
	{
		$authorname = $1;
		$authids = $authids . ";" . get_authid($authorname);
		$author_name = $author_name . ";" .$authorname;
	}
	elsif($line =~ /<page>(.*)<\/page>/)
	{
		$pages = $1;
		($page, $page_end) = split(/-/, $pages);
	}
	elsif($line =~ /<\/entry>/)
	{
		insert_article($title,$authids,$author_name,$page,$page_end,$volume,$issue,$year,$month,$mname);
		$authids = "";
		$author_name = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($title,$authids,$author_name,$page,$page_end,$volume,$issue,$year,$month,$mname) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$mname =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into article values('$title','$authids','$author_name','$page','$page_end','$volume','$issue','$year','$month','$mname','')");
	
	$sth1->execute();
	$sth1->finish();
}

sub get_authid()
{
	
	my($authorname) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author where authorname='$authorname'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}	
