<?php
require_once('connection_news.php'); 

if(isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = 1;
$num = 20;
$limit_start = ($page - 1) * $num;
$next = $page + 1;
$pre = $page - 1;

$query_news = "select * from news where status = '1' and department_id = '4' and category_id = '2' and (language = 'en' or language = 'ce') order by created_date desc ";
$news = $mysqli->query($query_news);
$rows_news = $news->num_rows;

$pages = ceil($rows_news/$num);
$query_news .= " LIMIT ".$limit_start.",".$num; 
$news = $mysqli->query($query_news);

if ($pages <= 10)
{
    $start = 1;
    $end = $pages;
}
else
{
    if ($page < 6)
    {
        $start = 1;
        $end = 10;
    }
    else if ($page >= $pages - 4)
    {
        $start = $pages - 9;
        $end = $pages;
    }
    else
    {
        $start = $page - 4;
        $end = $page + 5;
    }
}

$url = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING']))
{
    $url .= "?".$_SERVER['QUERY_STRING'];
}

function url_set_value($url, $key, $value)
{
    $a = explode('?', $url);
    $url_f = $a[0];
    $query = $a[1];
    parse_str($query, $arr);
    $arr[$key] = $value;
    return $url_f.'?'.http_build_query($arr);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Southern University College - Academic Affairs, Admission & Registration Office</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.list {
}

.list th{
	text-align: left;
	height: 20px;
	padding: 5px;
	border-bottom-width: 2px;
	border-bottom-style: solid;
	border-bottom-color: #0066CC;
	color: #114880;
}
.list td {
	padding: 5px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #CCC;
}

.list a:link {
	text-decoration: none;
	color: #000;
}
.list a:visited {
	text-decoration: none;
	color: #000;
}
.list a:hover {
	text-decoration: underline;
	color: #000;
}

.pages {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	line-height: 22px;
}
.pages a {
	display: block;
	padding-right: 3px;
	padding-left: 3px;
}
.pages a:link {
	color: #0054A6;
}
.pages a:visited {
	color: #0054A6;
}
.pages a:hover {
	text-decoration: none;
	background-color: #D7EBFF;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	color: #0054A6;
}
.page {
	float: left;
	min-width: 22px;
	height: 22px;
	margin: 3px;
	text-align: center;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: 1px 1px 1px #999;
	-webkit-box-shadow: 1px 1px 1px #999;
	box-shadow: 1px 1px 1px #999;
	background-color: #EAF5FF;
	border: 1px solid #9AC1E9;
	color: #0057B7;
}
.c_page {
	font-weight: bold;
	border: 1px solid #318BDD;
	background-color: #BDF;
	color: #000;
}
.c_page a:hover {
	color: #000;
	background-color: #BDF;
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
    <div class="title1">Notice</div>
    <table width="650" border="0" cellpadding="0" cellspacing="0" class="list">
      <tr>
        <th width="103">Date</th>
        <th>Title</th>
      </tr>
      <?php while($row_news = $news->fetch_array()){?>
      <tr>
        <td valign="top"><?php echo date('Y/m/d',strtotime($row_news['created_date'])); ?></td>
        <td valign="top"><a href="notice.php?id=<?php echo $row_news['id']; ?>"><?php echo $row_news['title']; ?></a></td>
      </tr>
      <?php } ?>
    </table>
    <p>
      <?php if($rows_news!=0){ ?>
    </p>
    <table border="0" align="center" cellpadding="0" cellspacing="0" class="pages">
      <tr>
        <td><div class="page" title="First Page"><a href="<?php echo url_set_value($url,"page",1); ?>">&lt;&lt;</a></div>
          <div class="page" title="Previous Page"><a <?php if($page>1) echo "href=\"".url_set_value($url,"page",$pre)."\""; ?>>&lt;</a></div>
          <?php for($i=$start;$i<=$end;$i++){ ?>
          <div class="page <?php if($i==$page) echo "c_page"; ?>"><a <?php if($i!=$page) echo "href=\"".url_set_value($url,"page",$i)."\"";?>><?php echo $i; ?></a></div>
          <?php }?>
          <div class="page" title="Next Page"><a <?php if($page<$pages) echo "href=\"".url_set_value($url,"page",$next)."\""; ?>>&gt;</a></div>
          <div class="page" title="Last Page"><a href="<?php echo url_set_value($url,"page",$pages); ?>">&gt;&gt;</a></div></td>
      </tr>
    </table>
    <?php } ?>
    <p>&nbsp;</p>
  </div>
  </div>
  <div class="footer"><iframe src="footer.html" frameborder="0" width="100%" height="100%" scrolling="no"></iframe></div>
</div>
</body>
</html>
