<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from khachhang  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Dữ liệu khách hàng đã được xóa";

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

	<title>Motorbike Rental Management |Admin Manage User   </title>

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

						<h2 class="page-title">Người Dùng</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Danh Sách Người dùng</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành Công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th> Họ và Tên</th>
											<th>Số điện thoại</th>
											<th>CCCD</th>
										<th>Ngày Sinh</th>
										<th>Địa chỉ</th>
										<th>Quận/Huyện</th>
										<th>Thành phố</th>
										<th>Ngày thuê xe</th>
										<th>Chỉnh sửa</th>

										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th> Họ và Tên</th>
											<th>Số điện thoại</th>
											<th>CCCD</th>
										<th>Ngày Sinh</th>
										<th>Địa chỉ</th>
										<th>Quận/Huyện</th>
										<th>Thành phố</th>
										<th>Ngày thuê xe</th>
										<th>Chỉnh sửa</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from  khachhang ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->HoVaTen);?></td>
											<td><?php echo htmlentities($result->SoDienThoai);?></td>
											<td><?php echo htmlentities($result->CCCD);?></td>
											<td><?php echo htmlentities($result->NgaySinh);?></td>
											<td><?php echo htmlentities($result->DiaChi);?></td>
											<td><?php echo htmlentities($result->Quan);?></td>
											<td><?php echo htmlentities($result->ThanhPho);?></td>
											<td><?php echo htmlentities($result->RegDate);?></td>
		<td><a href="edit-users.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="reg-users.php?del=<?php echo $result->id;?>" onclick="return confirm('Bạn có muốn xóa thông tin khách hàng');"><i class="fa fa-close"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>

									</tbody>
								</table>



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
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
