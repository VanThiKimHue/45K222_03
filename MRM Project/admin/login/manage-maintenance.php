<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
// Thực hiện xóa dữ liệu xe
if(isset($_REQUEST['del']))
	{
$delid=intval($_GET['del']);
$sql = "delete from baoduong WHERE  id=:delid";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
$msg=" 	Dữ liệu xe đã được xóa";
   
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
	<title>Motorbike Rental Management | Admin   </title>

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

						<h2 class="page-title">Quản Lý Bảo Dưỡng</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Danh sách xe</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành Công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Tên Xe</th>
											<th>ODO(Km) </th>
                                            <th>Số lần thay nhớt</th>
											<th>Ngày thay nhớt</th>
											<th>Ngày bảo dưỡng gần nhất</th>
											<th>Ngày bảo dưỡng kế tiếp</th>
											<th>Cảnh báo</th>
                                            <th>Chỉnh Sửa</th>
											<!-- <th>Loại Xe</th>
											<th>Năm Sản Xuất</th>
											<th>Chỉnh Sửa</th> -->
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Tên Xe</th>
											<th>ODO(Km) </th>
                                            <th>Số lần thay nhớt</th>
											<th>Ngày thay nhớt</th>
											<th>Ngày bảo dưỡng gần nhất</th>
											<th>Ngày bảo dưỡng kế tiếp</th>
											<th>Cảnh báo</th>
                                            <th>Chỉnh Sửa</th>
											<!-- <th>Loại Xe</th>
											<th>Năm Sản Xuất</th>
											<th>Chỉnh Sửa</th> -->
										</tr>
										</tr>
									</tfoot>
									<tbody>

<?php $sql = "SELECT thongtinxe.TenXe,thongtinxe.id,baoduong.*
    from baoduong 
    join thongtinxe on baoduong.idxe=thongtinxe.id";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$date = date('Y-m-d');
$newdate = strtotime ( '+0 day' , strtotime ( $date ) ) ;
$oneday= 24*60*60;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	$d=strtotime($result->NgayBDTT)			?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->TenXe);?></td>
											<td><?php echo htmlentities($result->ODO);?></td>
											<td><?php echo htmlentities($result->num);?></td>
											<td><?php echo htmlentities($result->NgayThayDau);?></td>
											<td><?php echo htmlentities($result->NgayBDGN);?></td>
											<td><?php echo htmlentities($result->NgayBDTT);?></td>
											<td>
												<?php if(($d-$newdate)==0 ):?>
												<span class="badge badge-danger" style="background-color: red; font-size: 14px;">Đến hạn bảo dưỡng</span>
												<?php elseif(($d-$newdate)==86400):?>
												<span class="badge badge-danger" style="background-color: red; font-size: 14px;">Sắp đến ngày bảo dưỡng</span>
												<?php elseif(($d-$newdate)<0):?>
												<span class="badge badge-danger" style="background-color: red; font-size: 14px;">Đã quá hạn bảo dưỡng</span>
												<?php elseif(($d-$newdate-$oneday)>86400):?>
												<span ></span> 
												<?php endif; ?>
											</td>
		<td><a href="edit-maintenance.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-maintenance.php?del=<?php echo $result->id;?>" onclick="return confirm('Bạn có muốn xóa hồ sơ xe');"><i class="fa fa-close"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>

									</tbody>
								</table>
                                <div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													<a href="add-maintenance.php" class="btn btn-primary" name="submit" type="button" id="submit"style="font-size: medium;">Thêm mới</a>
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
	<!-- <script src="js/jquery.dataTables.min.js"></script> -->
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
