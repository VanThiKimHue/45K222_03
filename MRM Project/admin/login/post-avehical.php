<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
// Thực hiện thêm xe
if(isset($_POST['submit']))
  {
$tenxe=$_POST['tenxe'];
$hangxe=$_POST['hangxe'];
$motaxe=$_POST['motaxe'];
$giathue=$_POST['giathue'];
$namsx=$_POST['namsx'];
$type=$_POST['type'];
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
$vimage5=$_FILES["img5"]["name"];
$type=$_POST['type'];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

$sql="INSERT INTO thongtinxe(TenXe,HangXe,MoTaXe,GiaThueTheoNgay,NamSanXuat,Type,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5) 
VALUES(:tenxe,:hangxe,:motaxe,:giathue,:namsx,:type,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5)";
$query = $dbh->prepare($sql);
$query->bindParam(':tenxe',$tenxe,PDO::PARAM_STR);
$query->bindParam(':hangxe',$hangxe,PDO::PARAM_STR);
$query->bindParam(':motaxe',$motaxe,PDO::PARAM_STR);
$query->bindParam(':giathue',$giathue,PDO::PARAM_STR);
$query->bindParam(':namsx',$namsx,PDO::PARAM_STR);
$query->bindParam(':type',$type,PDO::PARAM_STR);
$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
$query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
$query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
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

	<title>Motorbike Rental Management | Admin Thêm Phương Tiện</title>

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

						<h2 class="page-title">Thêm Phương Tiện</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Thông Tin Cơ bản</div>
<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Biển số xe<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="tenxe" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Hãng xe<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="hangxe" required>
<option value=""> Lựa chọn </option>
<?php $ret="select id,TenHang from hangxe";
$query= $dbh -> prepare($ret);
// $query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TenHang);?></option>
<?php }} ?>

</select>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Thông số xe<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="motaxe" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Giá theo ngày(VND)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="giathue" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Loại xe<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="type" required>
<option value=""> Lựa chọn </option>

<option value="Xe Số">Xe số</option>
<option value="Xe Ga">Xe Ga</option>
<option value="Xe Côn">Xe côn</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Năm sản xuất<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="namsx" class="form-control" required>
</div>
<!-- <label class="col-sm-2 control-label">Số chổ ngồi<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="seatingcapacity" class="form-control" required>
</div> -->
</div>
<div class="hr-dashed"></div>


<div class="form-group">
<div class="col-sm-12">
<h4><b>Thêm hình ảnh</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Hình ảnh 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Hình ảnh 2<input type="file" name="img2" >
</div>
<div class="col-sm-4">
Hình ảnh 3<input type="file" name="img3">
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Hình ảnh 4<input type="file" name="img4">
</div>
<div class="col-sm-4">
Hình ảnh 5<input type="file" name="img5">
</div>

</div>
<div class="hr-dashed"></div>
</div>
</div>
</div>
</div>





											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;"">
													<button class="btn btn-default" type="reset" style="font-size:medium">Hủy</button>
													<button class="btn btn-primary" name="submit" type="submit" style="font-size: medium;">Thêm phương tiện</button>
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