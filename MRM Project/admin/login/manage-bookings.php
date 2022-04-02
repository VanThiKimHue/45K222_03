<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$tinhtrang="2";
$sql = "UPDATE dathang SET TinhTrang=:tinhtrang WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':tinhtrang',$tinhtrang, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Đơn thuê xe đã được hủy";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$tinhtrang=1;

$sql = "UPDATE dathang SET TinhTrang=:tinhtrang WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':tinhtrang',$tinhtrang, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Đã hoàn thành trả xe";
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

	<title>Bike Rental Portal |Admin Manage testimonials   </title>

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

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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

	<!-- Modal -->
<div class="modal fade" id="viewbookingmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel" style="font-size:x-large">Thông tin chi tiết</h5>
<!--         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <div class="booking_viewing" style="font-size:large;">
        	
        </div>
      </div>
      <div class="modal-footer">
      	<!-- <button href="edit-booking.php?id=<?php echo $result->id;?>" name="edit" id="edit"type="button" class="btn btn-primary">Chỉnh sửa</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: grey;">Đóng</button>
        
      </div>
    </div>
  </div>
</div>

	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Quản lý đơn thuê xe</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Danh sách đơn hàng</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Khách hàng</th>
											<!-- <th>Xe thuê</th> -->
											<th>Ngày thuê</th>
											<th>Ngày trả</th>
											<!-- <th>Ghi chú</th> -->
											<th>Tình trạng</th>
											<th>Ngày nhập</th>
											<th>Chỉnh sửa</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Khách hàng</th>
											<!-- <th>Xe thuê</th> -->
											<th>Ngày thuê</th>
											<th>Ngày trả</th>
											<!-- <th>Ghi chú</th> -->
											<th>Tình trạng</th>
											<th>Ngày nhập</th>
											<th>Chỉnh sửa</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT khachhang.HoVaTen,dathang.NgayThue,dathang.NgayTra,dathang.GhiChu,dathang.idxe as vid,dathang.TinhTrang,dathang.NgayNhap,dathang.id  
									from dathang 
									join thongtinxe on thongtinxe.id=dathang.idxe 
									join khachhang on khachhang.id=dathang.idkhachhang";
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
											<td><?php echo htmlentities($result->NgayThue);?></td>
											<td><?php echo htmlentities($result->NgayTra);?></td>
											<td><?php
													if($result->TinhTrang==0)
													{
													echo htmlentities('Đã giao xe');
													} else if ($result->TinhTrang==1) {
													echo htmlentities('Đã trả xe');
													} else {
														echo htmlentities('Đã hủy đơn');
													}

										?></td>
											<td><?php echo htmlentities($result->NgayNhap);?></td>
										<td><a href="manage-bookings.php" id="<?php echo htmlentities($result->id);?>" class="view_btn" type="button"data-toggle="modal"  data-target="#myModal"> Xem chi tiết</a>/ 
											<a href="edit-booking.php?id=<?php echo $result->id;?>" name="edit" id="edit" class="edit">Chỉnh sửa</a>/ 
											<a href="manage-bookings.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm this booking')"> Hoàn Thành</a> /


											<a href="manage-bookings.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Bạn có muốn hủy đơn thuê xe này?')"> Hủy</a>
</td>

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

<script type="text/javascript">
	$(document).ready(function(){
		$('.view_btn').click(function(e){
			e.preventDefault();
			var b_id=$(this).attr('id');

			// console.log(b_id);
			// alert('hi')
			$.ajax({
				type:"POST",
				url:"view-booking.php",
				data: {
					'checking_view_btn': true,
					'booking_id': b_id,
				},
				success: function(response){
					console.log(response);
					$('.booking_viewing').html(response);
					$('#viewbookingmodal').modal('show');
				}
			});
	})
	})	
</script>
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
