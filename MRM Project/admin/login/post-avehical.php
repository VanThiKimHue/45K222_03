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
$namdk=$_POST['namdk'];
$sql="INSERT INTO thongtinxe(TenXe,HangXe,MoTaXe,GiaThueTheoNgay,NamSanXuat,NamDK,Type) 
VALUES(:tenxe,:hangxe,:motaxe,:giathue,:namsx,:namdk,:type)";
$query = $dbh->prepare($sql);
$query->bindParam(':tenxe',$tenxe,PDO::PARAM_STR);
$query->bindParam(':hangxe',$hangxe,PDO::PARAM_STR);
$query->bindParam(':motaxe',$motaxe,PDO::PARAM_STR);
$query->bindParam(':giathue',$giathue,PDO::PARAM_STR);
$query->bindParam(':namsx',$namsx,PDO::PARAM_STR);
$query->bindParam(':namdk',$namdk,PDO::PARAM_STR);
$query->bindParam(':type',$type,PDO::PARAM_STR);
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
	<link rel="shortcut icon" type="image/jpg" href="img/Snapseed.jpg"/>
	<title>Motorbike Rental Management | Admin</title>

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

	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
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
<div class="col-sm-2">
<input type="text" name="tenxe" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Hãng xe<span style="color:red">*</span></label>
<div class="col-sm-2">
	<select  class="form-control" name="hangxe"  id="hangxe" value="" required>
            <option value=""> Lựa chọn </option>
            <?php 
            $ret="select id,TenHang from hangxe";
            $query= $dbh -> prepare($ret);
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
<label class="col-sm-2 control-label">Màu xe<span style="color:red">*</span></label>
<div class="col-sm-2">
<textarea class="form-control" name="motaxe" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Giá theo ngày(VND)<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="text" name="giathue" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Loại xe<span style="color:red">*</span></label>
<div class="col-sm-2">
<select class="form-control" name="type" required>
<option value=""> Lựa chọn </option>

<option value="Xe Số">Xe số</option>
<option value="Xe Ga">Xe Ga</option>
<option value="Xe Côn">Xe côn</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Năm sản xuất<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="text" name="namsx" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Năm đăng ký lần đầu<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="text" name="namdk" class="form-control" required>
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
	<!-- <script src="js/jquery.min.js"></script> -->
	<script src="js/bootstrap-select.min.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>
<script>
        $("#hangxe").chosen();
    </script>
</html>

<?php } ?>
