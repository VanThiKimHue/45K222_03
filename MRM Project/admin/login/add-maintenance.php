<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
// Code thêm quản lý bảo dưỡng mới
if(isset($_POST['submit']))
{
$tenxe=$_POST['tenxe'];
$odo=$_POST['odo'];
$num=$_POST['num'];
$ngaythaynhot=$_POST['ngaythaynhot'];
$ngaybd=$_POST['ngaybaoduong'];
$ngaybdtt=$_POST['ngaybaoduongtt'];
$tinhtrangbd="1";
$sql1="UPDATE thongtinxe SET TinhTrangBD=:tinhtrangbd where id=:tenxe";
$query = $dbh->prepare($sql1);
$query -> bindParam(':tinhtrangbd',$tinhtrangbd, PDO::PARAM_STR);
$query-> bindParam(':tenxe',$tenxe, PDO::PARAM_STR);
$query -> execute();
$sql="INSERT INTO  baoduong(idxe,ODO,num,NgayThayDau,NgayBDGN,NgayBDTT) VALUES(:tenxe,:odo,:num,:ngaythaynhot,:ngaybaoduong,:ngaybaoduongtt)";
$query = $dbh->prepare($sql);
$query->bindParam(':tenxe',$tenxe,PDO::PARAM_STR);
$query->bindParam(':odo',$odo,PDO::PARAM_STR);
$query->bindParam(':num',$num,PDO::PARAM_STR);
$query->bindParam(':ngaythaynhot',$ngaythaynhot,PDO::PARAM_STR);
$query->bindParam(':ngaybaoduong',$ngaybd,PDO::PARAM_STR);
$query->bindParam(':ngaybaoduongtt',$ngaybdtt,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg=" Tạo bản quản lý bảo dưỡng mới thành công";
}
else
{
$error=" Đã xảy ra lỗi. Vui lòng thử lại";
}

}
if(isset($_POST['back']))
{
	header("Location: manage-maintenance.php");
exit;
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<link rel="shortcut icon" type="image/jpg" href="img/Snapseed.jpg"/>
	<title>Motorbike Rental Management | Admin </title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.chosen-container {
font-size:18px;
}

.chosen-container-single .chosen-single {
    height: 40px;
    padding: 7px 0 0 8px;
}
.chosen-container-single .chosen-single div{
top:7px;
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Thêm Thông Tin Bảo Dưỡng Mới</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"></div>
									<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">

<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
 <label class="col-sm-2 control-label">Tên Xe<span style="color:red">*</span></label>
 <div class="col-sm-2">
  	<select class="form-control" name="tenxe" id="tenxe"required>
	<option value=""> Lựa chọn </option>
	<?php 
	$ret="select id,TenXe from thongtinxe where TinhTrangBD=0";
	$query= $dbh -> prepare($ret);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
	foreach($results as $result)
	{
	?>
	<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TenXe);?></option>
	<?php }} ?>

    </select>
 </div>

 <div class="form-group">
 <label class="col-sm-2 control-label">Số ODO(Km)<span style="color:red">*</span></label>
 <div class="col-sm-2">
	<input class="form-control" name="odo" required>
    
 </div>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label">Số lần thay nhớt<span style="color:red">*</span></label>
<div class="col-sm-2">
<input class="form-control" type="number" name="num" required>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Ngày thay nhớt<span style="color:red">*</span></label>
<div class="col-sm-2">
<input class="today form-control"  name="ngaythaynhot" required>
</div>
</div>

</div>

<div class="form-group">
<label class="col-sm-2 control-label">Ngày bảo dưỡng gần nhất<span style="color:red">*</span></label>
<div class="col-sm-2">
<input class="day form-control"   name="ngaybaoduong" value="" required>
</div>

<div  class="form-group">
<label class="col-sm-2 control-label">Ngày bảo dưỡng kế tiếp<span style="color:red">*</span></label>
<div class="col-sm-2">
<input  class="ngaytt form-control"  name="ngaybaoduongtt" id="ngaytt" value="" required readonly>
</div>
</div>

</div>
<script type="text/javascript">


$('.day').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
$('.today').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
$('.day').datepicker().bind("change", function () {

    calculate();
});
function calculate() {
    var d1 = $('.day').datepicker('getDate','getMonth','getFullYear');
    var d2= new Date();
	d2.setFullYear(d1.getFullYear());
	d2.setMonth(d1.getMonth() + 3);
	d2.setDate(d1.getDate());
    $('.ngaytt').val(d2.toISOString().split('T')[0]);
  }
</script>
<br>
<br>
<br>
<br>

</div>







											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													
													<button class="btn btn-default" type="reset" style="font-size:medium">Hủy</button>
													<button class="btn btn-primary" name="submit" type="submit" id="submit"style="font-size: medium;">Thêm mới</button>
												</div>
											</div>
</form>


									</div>
								</div>
							</div>

						</div>

						<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													<a href="manage-maintenance.php" class="btn btn-default" name="back" type="button" id="back"style="font-size: medium; background-color: grey;">Quay lại</a>
												</div>

					</div>
				</div>


			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<!-- <script src="js/bootstrap-select.min.js"></script> -->
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script src="js/jautocalc.js"></script>
	<script src="js/script.js"></script>
	<script>
		$("#tenxe").chosen();
    </script>
</body>
</html>
<?php } ?>
