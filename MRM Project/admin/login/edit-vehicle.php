<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{

if(isset($_POST['submit']))
  {

$tenxe=$_POST['tenxe'];
$hangxe=$_POST['hangxe'];
$motaxe=$_POST['motaxe'];
$giathue=$_POST['giathue'];
$namsx=$_POST['namsx'];
$type=$_POST['type'];

$id=intval($_GET['id']);

$sql="update thongtinxe set TenXe=:tenxe,HangXe=:hangxe,MoTaXe=:motaxe,GiaThueTheoNgay=:giathue,Type=:type,NamSanXuat=:namsx where id=:id ";
$query = $dbh->prepare($sql);
$query->bindParam(':tenxe',$tenxe,PDO::PARAM_STR);
$query->bindParam(':hangxe',$hangxe,PDO::PARAM_STR);
$query->bindParam(':motaxe',$motaxe,PDO::PARAM_STR);
$query->bindParam(':giathue',$giathue,PDO::PARAM_STR);
$query->bindParam(':namsx',$namsx,PDO::PARAM_STR);
$query->bindParam(':type',$type,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Cập nhật thông tin xe thành công";


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

	<title>Motorbike Rental Management | Admin Edit Vehicle Info</title>

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

						<h2 class="page-title">Cập Nhật Thông Tin Xe</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Thông Tin Cơ Bản</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php
$id=intval($_GET['id']);
$sql ="SELECT thongtinxe.*,hangxe.TenHang,hangxe.id as bid from thongtinxe join hangxe on hangxe.id=thongtinxe.HangXe where thongtinxe.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Biển số xe<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="tenxe" class="form-control" value="<?php echo htmlentities($result->TenXe)?>" required>
</div>
<label class="col-sm-2 control-label">Hãng xe<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="hangxe" required>
<option value="<?php echo htmlentities($result->bid);?>"><?php echo htmlentities($bdname=$result->TenHang); ?> </option>
<?php $ret="select id,TenHang from hangxe";
$query= $dbh -> prepare($ret);
//$query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$resultss = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($resultss as $results)
{
if($results->HangXe==$bdname)
{
continue;
} else{
?>
<option value="<?php echo htmlentities($results->id);?>"><?php echo htmlentities($results->TenHang);?></option>
<?php }}} ?>

</select>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Thông số xe<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="motaxe" rows="3" required><?php echo htmlentities($result->MoTaXe);?></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Giá theo ngày(VND)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="giathue" class="form-control" value="<?php echo htmlentities($result->GiaThueTheoNgay);?>" required>
</div>
<label class="col-sm-2 control-label">Loại xe<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="type" required>
<option value="<?php echo htmlentities($results->type);?>"> <?php echo htmlentities($result->Type);?> </option>

<option value="Xe Số">Xe Số</option>
<option value="Xe Ga">Xe Ga</option>
<option value="Xe Côn">Xe Côn</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Năm sản xuất<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="namsx" class="form-control" value="<?php echo htmlentities($result->NamSanXuat);?>" required>
<!-- </div>
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($result->SeatingCapacity);?>" required>
</div> -->
</div>
<div class="hr-dashed"></div>
<div class="form-group">
<div class="col-sm-12">
<h4><b>Hình ảnh xe</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Ảnh 1 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">Thay ảnh 1</a>
</div>
<div class="col-sm-4">
Ảnh 2
<?php if($result->Vimage5=="")
{
echo htmlentities("không có");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Thay ảnh 2</a>
<?php } ?>
</div>
<div class="col-sm-4">
Ảnh 3
<?php if($result->Vimage5=="")
{
echo htmlentities("không có");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">Thay ảnh 3</a>
<?php } ?>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Ảnh 4
<?php if($result->Vimage5=="")
{
echo htmlentities("không có");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id)?>">Thay ảnh 4</a>
<?php } ?>
</div>
<div class="col-sm-4">
Ảnh 5
<?php if($result->Vimage5=="")
{
echo htmlentities("không có");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage5.php?imgid=<?php echo htmlentities($result->id)?>">Thay ảnh 5</a>
<?php } ?>
</div>

</div>
<div class="hr-dashed"></div>
</div>
</div>
</div>
</div>



<?php }} ?>


											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >

													<button class="btn btn-primary" name="submit" type="submit" style="margin: auto; display:block; font-size: medium;">Lưu thay đổi</button>
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
