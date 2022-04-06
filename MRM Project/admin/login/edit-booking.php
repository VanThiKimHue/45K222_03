<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}else{
if(isset($_POST['submit']))
{
$khachhang=$_POST['khachhang'];
$xethue=$_POST['xethue']; 
$ngaythue=$_POST['ngaythue'];
$ngaytra=$_POST['ngaytra'];
$songaythue=$_POST['songaythue'];
$giatrihopdong=$_POST['giatrihopdong']; 
$datcoc=$_POST['datcoc'];
$conlai=$_POST['conlai'];
$ghichu=$_POST['ghichu'];
$id=intval($_GET['id']);
$sql="update dathang set idkhachhang=:khachhang,idxe=:xethue,NgayThue=:ngaythue,NgayTra=:ngaytra,SoNgayThue=:songaythue,GiaTriHopDong=:giatrihopdong,DatTruoc=:datcoc,ConLai=:conlai,GhiChu=:ghichu where id=:id)";
$query = $dbh->prepare($sql);
$query->bindParam(':khachhang',$khachhang,PDO::PARAM_STR);
$query->bindParam(':xethue',$xethue,PDO::PARAM_STR);
$query->bindParam(':ngaythue',$ngaythue,PDO::PARAM_STR);
$query->bindParam(':ngaytra',$ngaytra,PDO::PARAM_STR);
$query->bindParam(':songaythue',$songaythue,PDO::PARAM_STR);
$query->bindParam(':giatrihopdong',$giatrihopdong,PDO::PARAM_STR);
$query->bindParam(':datcoc',$datcoc,PDO::PARAM_STR);
$query->bindParam(':conlai',$conlai,PDO::PARAM_STR);
$query->bindParam(':ghichu',$ghichu,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
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

if(isset($_POST['back']))
{
	header("Location: manage-bookings.php");
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

	<title>Motorbike Rental Management | Admin Chỉnh Sửa Đơn Thuê Xe</title>

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

						<h2 class="page-title">Chỉnh sửa đơn thuê xe</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Thông Tin Cơ bản</div>
<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php
$id=intval($_GET['id']);
$sql ="SELECT dathang.*,khachhang.HoVaTen,thongtinxe.TenXe,thongtinxe.GiaThueTheoNgay,thongtinxe.id as vid
from dathang 
join khachhang on dathang.idkhachhang=khachhang.id 
join thongtinxe on dathang.idxe=thongtinxe.id 
where dathang.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
// $cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

	<div class="panel-body">

<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
 <label class="col-sm-2 control-label">Khách hàng<span style="color:red">*</span></label>
 <div class="col-sm-3">
  	<input class="form-control" name="khachhang" value="<?php echo htmlentities($result->HoVaTen);?>" required readonly>

    </input>
 </div>

 <div class="form-group">
 <label class="col-sm-2 control-label">Xe Thuê<span style="color:red">*</span></label>
 <div class="col-sm-3">
	<select class="selectpicker" name="xethue">
	<option value="<?php echo htmlentities($result->bid);?>"><?php echo htmlentities($bdname=$result->TenXe);?></option>
	<?php 
	$ret="select id,TenXe from thongtinxe";
	$query= $dbh -> prepare($ret);
	$query-> execute();
	$resultss = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
	foreach($resultss as $results)
	{
		if($results->TenXe==$bdname)
		{
		continue;
	}else{
	?>
	<option value="<?php echo htmlentities($results->id);?>"><?php echo htmlentities($results->TenXe);?></option>
	<?php }}} ?>

    </select>
 </div>
</div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Ngày Thuê<span style="color:red">*</span></label>
 <div class="col-sm-3">
 <input  class="fromdate" name="ngaythue"  value="<?php echo htmlentities($result->NgayThue);?>" required readonly>
</div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Ngày Trả<span style="color:red">*</span></label>
 <div class="col-sm-3">
 <input  class="todate" name="ngaytra" value="<?php echo htmlentities($result->NgayTra);?>" required>
</div>
</div>



<div class="form-group">
 <label class="col-sm-2 control-label">Số ngày thuê<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input  name="songaythue" id="songaythue"  class="calculated" value="<?php echo htmlentities($result->SoNgayThue);?>" required readonly>
 </div>
</div>
<!-- > Tính số ngày thuê<-->
<script type="text/javascript">
	        $('.fromdate').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
$('.todate').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
$('.fromdate').datepicker().bind("change", function () {
    var minValue = $(this).val();
    minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
    $('.todate').datepicker("option", "minDate", minValue);
    calculate();
});
$('.todate').datepicker().bind("change", function () {
    var maxValue = $(this).val();
    maxValue = $.datepicker.parseDate("yy-mm-dd", maxValue);
    $('.fromdate').datepicker("option", "maxDate", maxValue);
    calculate();
});

function calculate() {
    var d1 = $('.fromdate').datepicker('getDate');
    var d2 = $('.todate').datepicker('getDate');
    var oneDay = 24*60*60*1000;
    var diff = 0;
    if (d1 && d2) {
  
      diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay))) +1;
    }
    $('.calculated').val(diff);
  }
</script>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Giá thuê(VND/ngày)<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="giathue" class="form-control" value="<?php echo htmlentities($result->GiaThueTheoNgay);?>" required readonly>
</div>
 <label class="col-sm-2 control-label">Giá trị hợp đồng(VND)<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="giatrihopdong" class="form-control" jAutoCalc="{songaythue}*{giathue}" required readonly>
 </div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Đặt cọc(VND)</label>
 <div class="col-sm-3">
  <input type="text" name="datcoc" class="form-control" value="<?php echo htmlentities($result->DatTruoc);?>" readonly>
 </div>
  <label class="col-sm-2 control-label">Còn lại(VND)<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="conlai" class="form-control" value="<?php echo htmlentities($result->ConLai);?>" jAutoCalc="{giatrihopdong} - {datcoc}" required readonly>
 </div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
 <label class="col-sm-2 control-label">Ghi Chú</label>
 <div class="col-sm-8">
  <input type="text" name="ghichu" class="form-control" rows="3" value="<?php echo htmlentities($result->GhiChu);?>">
 </div>
</div>
</div>
</div>
<?php }} ?>








											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													<button class="btn btn-default" type="back" name="back" style="font-size:medium">Hủy</button>
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
</body>
</html>
<?php } ?>