<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
// code thêm thông tin khách hàng
else{
if(isset($_POST['submit']))
{
$hovaten=$_POST['hovaten'];
$email=$_POST['email']; 
$sdt=$_POST['sdt'];
$cccd=$_POST['cccd'];
$bdate=$_POST['bdate']; 
$diachi=$_POST['diachi'];
$quan=$_POST['quan'];
$thanhpho=$_POST['thanhpho'];
$sql="INSERT INTO  khachhang(HoVaTen,Email,CCCD,SoDienThoai,Ngaysinh,DiaChi,Quan,ThanhPho) VALUES(:hovaten,:email,:cccd,:sdt,:bdate,:diachi,:quan,:thanhpho)";
$query = $dbh->prepare($sql);
$query->bindParam(':hovaten',$hovaten,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':sdt',$sdt,PDO::PARAM_STR);
$query->bindParam(':cccd',$cccd,PDO::PARAM_STR);
$query->bindParam(':bdate',$bdate,PDO::PARAM_STR);
$query->bindParam(':diachi',$diachi,PDO::PARAM_STR);
$query->bindParam(':quan',$quan,PDO::PARAM_STR);
$query->bindParam(':thanhpho',$thanhpho,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg=" Đăng thành công";
}
else
{
$error=" Có lỗi xảy ra. Vui lòng thử lại";
}


}
	?>

<!-- Hiển thị giao diện thêm sản phẩm -->
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>Motorbike Rental Management | Admin Thêm Khách Hàng</title>

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

						<h2 class="page-title">Thêm Khách Hàng</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Thông Tin Cơ bản</div>
<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
 <label class="col-sm-2 control-label">Họ và tên<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="hovaten" class="form-control" required>
 </div>

 <div class="form-group">
 <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="email" name="email" class="form-control" id="email" onBlur="checkAvailability()" required="required">
  <span id="user-availability-status" style="font-size:12px;"></span>
  <!-- kiểm tra email hợp lệ -->
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
 </div>
</div>
</div>




<!-- <div class="hr-dashed"></div> -->
<div class="form-group">
 <label class="col-sm-2 control-label">CCCD<span style="color:red">*</span></label>
 <div class="col-sm-3">
	<input type="text" name="cccd" class="form-control" required>
 </div>
<div class="form-group">
 <label class="col-sm-2 control-label">Số điện thoại<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="sdt" class="form-control" required>
 </div>
</div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Ngày sinh<span style="color:red">*</span></label>
 <div class="col-sm-3">
 <input type="date" class="form-control" name="bdate" value="<?php echo date("Y-m-d")?>" required>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
 <label class="col-sm-2 control-label">Địa chỉ<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="diachi" class="form-control" required>
 </div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Quận/Huyện<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="quan" class="form-control" required>
</div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Tỉnh/Thành phố<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="thanhpho" class="form-control" required>
 </div>
</div>
</div>
</div>







											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;"">
													<button class="btn btn-default" type="reset" style="font-size:medium">Hủy</button>
													<button class="btn btn-primary" name="submit" type="submit" id="submit"style="font-size: medium;">Thêm khách hàng</button>
												</div>
											</div>
</form>
									</div>
								</div>
							</div>
						</div>



					</div>
				</div>



			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
