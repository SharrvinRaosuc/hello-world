<?php
require_once('connection_news.php'); 

if (isset($_GET['id']))
{
	//$query_news = "select * from news where status = '1' and id = '".mysql_real_escape_string($_GET[id])."'";
	$query_news = "select * from news where status = ? and id = ? ";
	$news = $mysqli->prepare($query_news);
	$status = 1;
	$id = $_GET['id'];
	$news->bind_param('ii', $status, $id);
	$news->execute();
	$result = $news->get_result();	
	//$news = mysql_query($query_news) or die(mysql_error());
	$row_news = $result->fetch_array();	
	//$row_news = mysql_fetch_array($news);
	if(!$row_news)
		header("Location: notice_list.php"); 	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南方大学学院 - 教务与入学注册处</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.news {
	width: 670px;
	text-align: left;
}

.news img {
	max-width: 670px;
	height: auto;
}
.news_info {	
	text-align: center;
	font-size: 12px;
}
.news_title {
	font-size: 16px;
	font-weight: bold;
	text-align: center;
	color: #3663AD;
}
</style>
</head>

<body>
<div class="container">
  <div class="header"><iframe src="header.html" frameborder="0" width="100%" height="100%" scrolling="no"></iframe></div>
  <div class="content">
  <div class="menu">
    <iframe src="menu.html" frameborder="0" width="100%" height="100%" scrolling="no"></iframe>
  </div>
  <div class="right">
    <div class="title1">通告</div>
    <div class="news">
      <p class="news_title"><?php echo $row_news[title]; ?></p>
      <p class="news_info"><strong>日期：</strong><?php echo date('Y/m/d',strtotime($row_news['created_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="notice_list.php">通告列表</a></p>
      <p><?php echo $row_news['content']; ?></p>
    </div>
    <p>&nbsp;</p>
  </div>
  </div>
  <div class="footer"><iframe src="footer.html" frameborder="0" width="100%" height="100%" scrolling="no"></iframe></div>
</div>
</body>
</html>
