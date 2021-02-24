<?php
require_once('connection_wcms.php'); 

$today = date('Y-m-d');
$query_dir = "select * from directory as d left join staff_department as sd on d.id = sd.directory_id where d.status = '1' and sd.department_id = '5' and d.job_category = 'F' and (effective_date > '$today' or effective_date = '') ";
$query_director = $query_dir."and sd.section_id = '' order by sd.order";
$unit[1] = $mysqli->query($query_director);
$query_riunit = $query_dir."and sd.section_id = '3' order by sd.order";
$unit[2] = $mysqli->query($query_riunit);
$query_cpunit = $query_dir."and sd.section_id = '4' order by sd.order";
$unit[3] = $mysqli->query($query_cpunit);
$query_exunit = $query_dir."and sd.section_id = '5' order by sd.order";
$unit[4] = $mysqli->query($query_exunit);

$title[2] = "Registration & Information Unit";
$title[3] = "Course & Program Unit";
$title[4] = "Examination Unit";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Southern University College - Academic Affairs, Admission & Registration Office</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.staff {	border: 1px solid #999;
	-moz-box-shadow: 3px 3px 2px #CCC;
	-webkit-box-shadow: 3px 3px 2px #CCC;
	box-shadow: 3px 3px 2px #CCC;
	padding: 7px;
	margin-bottom: 10px;
	overflow: hidden;
	width: 400px;
}
.staff_data {	float: left;
	width: 280px;
}
.staff_photo {	border: 1px solid #CCCCCC;
	float: left;
	margin-right: 10px;
}

.staff_photo img {
	width: 100px;
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
    <div class="title1">Staff</div>
    
    <?php for($i=1;$i<=4;$i++) { ?>
    <?php if($i>1) echo "<h3>$title[$i]</h3>"; ?>
        
    <p>
      <?php while($row_dir = $unit[$i]->fetch_array()){ ?>
    </p>
    <div class="staff">
      <div class="staff_photo"><img src="/WCMS/directory/photo/<?php echo $row_dir[photo]; ?>"/></div>
      <div class="staff_data">
        <table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="62" valign="top"><strong>Name:</strong></td>
            <td valign="top"><?php echo $row_dir['en_name']; ?></td>
          </tr>
          <tr>
            <td valign="top"><strong>Position:</strong></td>
            <td valign="top"><?php echo $row_dir['en_position']; ?></td>
          </tr>
          <tr>
            <td valign="top"><strong>Ext No.:</strong></td>
            <td valign="top"><?php if($row_dir['ext_no']!="") echo $row_dir['ext_no']; else echo "-"; ?></td>
          </tr>
          <tr>
            <td valign="top"><strong>Email:</strong></td>
            <td valign="top"><?php if($row_dir['email']!=""){ ?>
              <a href="mailto:<?php echo $row_dir['email']; ?>"><?php echo $row_dir['email']; ?></a>
              <?php } else echo "-"; ?></td>
          </tr>
        </table>
      </div>
    </div>
    <p>
      <?php }} ?>
    </p>
    <p>&nbsp;</p>
  </div>
  </div>
  <div class="footer"><iframe src="footer.html" frameborder="0" width="100%" height="100%" scrolling="no"></iframe></div>
</div>
</body>
</html>
