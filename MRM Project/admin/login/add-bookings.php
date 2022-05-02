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
$phikhac=$_POST['phikhac'];
$ghichu=$_POST['ghichu'];
$tinhtrang="1";
$sql1="UPDATE thongtinxe SET TinhTrang=:tinhtrang where id=:xethue";
$query = $dbh->prepare($sql1);
$query -> bindParam(':tinhtrang',$tinhtrang, PDO::PARAM_STR);
$query-> bindParam(':xethue',$xethue, PDO::PARAM_STR);
$query -> execute();
$sql="INSERT INTO  dathang (idkhachhang,idxe,NgayThue,NgayTra,SoNgayThue,GiaTriHopDong,DatTruoc,ConLai,PhiKhac,GhiChu) VALUES(:khachhang,:xethue,:ngaythue,:ngaytra,:songaythue,:giatrihopdong,:datcoc,:conlai,:phikhac,:ghichu)";
$query = $dbh->prepare($sql);
$query->bindParam(':khachhang',$khachhang,PDO::PARAM_STR);
$query->bindParam(':xethue',$xethue,PDO::PARAM_STR);
$query->bindParam(':ngaythue',$ngaythue,PDO::PARAM_STR);
$query->bindParam(':ngaytra',$ngaytra,PDO::PARAM_STR);
$query->bindParam(':songaythue',$songaythue,PDO::PARAM_STR);
$query->bindParam(':giatrihopdong',$giatrihopdong,PDO::PARAM_STR);
$query->bindParam(':datcoc',$datcoc,PDO::PARAM_STR);
$query->bindParam(':conlai',$conlai,PDO::PARAM_STR);
$query->bindParam(':phikhac',$phikhac,PDO::PARAM_STR);
$query->bindParam(':ghichu',$ghichu,PDO::PARAM_STR);
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

						<h2 class="page-title">Thêm đơn hàng</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Thông Tin Cơ bản</div>
<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">

<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
 <label class="col-sm-2 control-label">Khách hàng<span style="color:red">*</span></label>
 <div class="col-sm-3">
  	<select class="form-control" name="khachhang" id="khachhang" required readonly>
	<option value=""> Lựa chọn </option>
	<?php 
	$ret="select id,HoVaTen from khachhang";
	$query= $dbh -> prepare($ret);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
	foreach($results as $result)
	{
	?>
	<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->HoVaTen);?></option>
	<?php }} ?>

    </select>
 </div>

 <div class="form-group">
 <label class="col-sm-2 control-label">Xe Thuê<span style="color:red">*</span></label>
 <div class="col-sm-3">
	<select class="form-control" name="xethue" id="xethue" required>
	<option value=""> Lựa chọn </option>
	<?php 
	$t="";
	$ret="select id,TenXe,GiaThueTheoNgay from thongtinxe where TinhTrang=0";
	$query= $dbh -> prepare($ret);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
	foreach($results as $result)
	{ 
		$t=$result->GiaThueTheoNgay;
	?>
	<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TenXe);?> - <?php echo htmlentities($result->GiaThueTheoNgay);?> VNĐ/ngày</option>
	<?php }}?>


    </select>
 </div>

</div>
</div>


<div class="form-group">
 <label class="col-sm-2 control-label">Ngày Thuê<span style="color:red">*</span></label>
 <div class="col-sm-3">
 <input  class="fromdate form-control" name="ngaythue"  value="" required>
</div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Ngày Trả<span style="color:red">*</span></label>
 <div class="col-sm-3">
 <input  class="todate form-control" name="ngaytra" value="" required>
</div>
</div>



<div class="form-group">
 <label class="col-sm-2 control-label">Số ngày thuê<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input  name="songaythue" id="songaythue"  class="calculated form-control" value="" required readonly>
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
<input type="text" name="giathue" class="form-control" value="" required >
</div>
 <label class="col-sm-2 control-label">Giá trị hợp đồng(VND)<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="giatrihopdong" class="form-control" jAutoCalc="{songaythue}*{giathue}+{phikhac}" required readonly>
 </div>
</div>

<div class="form-group">
 <label class="col-sm-2 control-label">Đặt cọc(VND)</label>
 <div class="col-sm-3">
  <input type="text" name="datcoc" class="form-control" value="">
 </div>
  <label class="col-sm-2 control-label">Còn lại(VND)<span style="color:red">*</span></label>
 <div class="col-sm-3">
  <input type="text" name="conlai" class="form-control" jAutoCalc="{giatrihopdong} - {datcoc}" required readonly>
 </div>
</div>
<div class="form-group">
 <label class="col-sm-2 control-label">Chi phí khác</label>
 <div class="col-sm-3">
  <input type="text" name="phikhac" class="form-control">
 </div>
</div>
<div class="hr-dashed"></div>
<div class="form-group">
 <label class="col-sm-2 control-label">Ghi Chú</label>
 <div class="col-sm-8">
  <input type="text" name="ghichu" class="form-control" rows="3">
 </div>
</div>
</div>
</div>







											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													<button class="btn btn-default" type="reset" style="font-size:medium">Hủy</button>
													<button class="btn btn-primary" name="submit" type="submit" id="submit" style="font-size: medium;">Thêm đơn thuê xe</button>
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
        $("#khachhang").chosen();
		$("#xethue").chosen();
    </script>
</body>
</html>
<?php } ?>