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
$ngaymua=$_POST['ngaymua'];
$ngayhet=$_POST['ngayhet'];
$phi=$_POST['phi'];
$id=intval($_GET['id']);
$sql="update baohiem set idxe=:tenxe,NgayMua=:ngaymua,NgayHet=:ngayhet, SoTien=:phi where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':tenxe',$tenxe,PDO::PARAM_STR);
$query->bindParam(':ngaymua',$ngaymua,PDO::PARAM_STR);
$query->bindParam(':ngayhet',$ngayhet,PDO::PARAM_STR);
$query->bindParam(':phi',$phi,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg=" Cập nhật bản quản lý bảo hiểm mới thành công";


}
if(isset($_POST['back']))
{
	header("Location: manage-insurance.php");
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

						<h2 class="page-title">Thêm Thông Tin Bảo Hiểm Mới</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"></div>
									<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<?php
$id=intval($_GET['id']);
$sql ="SELECT baohiem.*, thongtinxe.TenXe, thongtinxe.id as cid
from baohiem  
join thongtinxe on baohiem.idxe=thongtinxe.id 
where baohiem.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
 <label class="col-sm-2 control-label">Tên Xe<span style="color:red">*</span></label>
 <div class="col-sm-2">
  	<select class="form-control" name="tenxe" id="tenxe" required>
	  <option value="<?php echo htmlentities($result->cid);?>"><?php echo htmlentities($vname=$result->TenXe); ?> </option>
		<?php $ret="select id,TenXe from thongtinxe";
		$query= $dbh -> prepare($ret);
		//$query->bindParam(':id',$id, PDO::PARAM_STR);
		$query-> execute();
		$resultss = $query -> fetchAll(PDO::FETCH_OBJ);
		if($query -> rowCount() > 0)
		{
		foreach($resultss as $results)
		{
		if($results->TenXe==$vname)
		{
		continue;
		} else{
		?>
		<option value="<?php echo htmlentities($results->id);?>"><?php echo htmlentities($results->TenXe); ?></option>
	<?php }}} ?>

    </select>
 </div>
</div>


<div class="form-group">
 <label class="col-sm-2 control-label">Ngày mua<span style="color:red">*</span></label>
 <div class="col-sm-2">
 <input  class="fromdate form-control" name="ngaymua"  value="<?php echo htmlentities($result->NgayMua);?>" required>
</div>

 <label class="col-sm-2 control-label">Ngày hết hạn<span style="color:red">*</span></label>
 <div class="col-sm-2">
 <input  class="todate form-control" name="ngayhet" value="<?php echo htmlentities($result->NgayHet);?>" required readonly>
</div>
</div>
<script type="text/javascript">
	$('.fromdate').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
$('.fromdate').datepicker().bind("change", function () {

calculate();
});
function calculate() {
    var d1 = $('.fromdate').datepicker('getDate','getMonth','getFullYear');
    var d2= new Date();
	d2.setFullYear(d1.getFullYear() +1);
	d2.setMonth(d1.getMonth());
	d2.setDate(d1.getDate());
    $('.todate').val(d2.toISOString().split('T')[0]);
  }
</script>
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Số tiền đã trả<span style="color:red">*</span></label>
<div class="col-sm-2">
<input class="form-control" tpye="number" name="phi" value="<?php echo htmlentities($result->SoTien);?>" required>
</div>
<?php }}?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>
</div>







											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													
													<button class="btn btn-default" type="back" name="back" style="font-size:medium">Quay lại</button>
													<button class="btn btn-primary" name="submit" type="submit" id="submit"style="font-size: medium;">Cập nhật</button>
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
	<!-- <script src="js/jquery.min.js"></script> -->
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
