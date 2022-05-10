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
$xethue=intval($_GET['vid']);
$tinhtrangxe="0";
$sql = "UPDATE dathang SET TinhTrang=:tinhtrang WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':tinhtrang',$tinhtrang, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();
$sql1="UPDATE thongtinxe SET TinhTrang=:tinhtrangxe where id=:vid";
$query = $dbh->prepare($sql1);
$query -> bindParam(':tinhtrangxe',$tinhtrangxe, PDO::PARAM_STR);
$query -> bindParam(':vid',$xethue, PDO::PARAM_STR);
$query -> execute();
$msg="Đơn thuê xe đã được hủy";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$tinhtrang=1;
$xethue=intval($_GET['vid']);
$tinhtrangxe="0";
$sql = "UPDATE dathang SET TinhTrang=:tinhtrang WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':tinhtrang',$tinhtrang, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
$sql1="UPDATE thongtinxe SET TinhTrang=:tinhtrangxe where id=:vid";
$query = $dbh->prepare($sql1);
$query -> bindParam(':tinhtrangxe',$tinhtrangxe, PDO::PARAM_STR);
$query -> bindParam(':vid',$xethue, PDO::PARAM_STR);
$query -> execute();
$msg="Đơn thuê xe đã được hoàn thành";
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
	<!-- <link rel="stylesheet" href="css/bootstrap-select.css"> -->
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
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
<div class="modal fade" id="viewbookingmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel" style="font-size:x-large">Thông tin chi tiết</h5>

      </div>

        <div class="booking_viewing" style="font-size:large;">
        	

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: grey; color: white; font-size: 14px;">Đóng</button>
        
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
							<div class="panel-heading" style="font-size:15px;">Danh sách đơn hàng</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Khách hàng</th>
											<th>Xe thuê</th>
											<th>Ngày thuê</th>
											<th>Ngày trả</th>
											<!-- <th>Ghi chú</th> -->
											<th>Tình trạng</th>
											<th>Cảnh báo</th>
											<th>Ngày nhập</th>
											<th>Hành động</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Khách hàng</th>
											<th>Xe thuê</th>
											<th>Ngày thuê</th>
											<th>Ngày trả</th>
											<!-- <th>Ghi chú</th> -->
											<th>Tình trạng</th>
											<th>Cảnh báo</th>
											<th>Ngày nhập</th>
											<th>Hành động</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT khachhang.HoVaTen,thongtinxe.TenXe,dathang.NgayThue,dathang.NgayTra,dathang.GhiChu,dathang.idxe as vid,dathang.TinhTrang,dathang.NgayNhap,dathang.id  
									from dathang 
									join thongtinxe on thongtinxe.id=dathang.idxe 
									join khachhang on khachhang.id=dathang.idkhachhang";
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
{		$d=strtotime($result->NgayTra);			?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->HoVaTen);?></td>
											<td><?php echo htmlentities($result->TenXe);?></td>
											<td><?php echo htmlentities($result->NgayThue);?></td>
											<td><?php echo htmlentities($result->NgayTra);?></td>
											<td>
												<?php if($result->TinhTrang==0): ?>
													<span class="badge badge-primary" style="font-size: 14px;">Đã giao xe</span>
												<?php elseif($result->TinhTrang==1): ?>
													 <span >Đã trả xe</span>
												 <?php elseif($result->TinhTrang==2): ?>
													 <span class="badge badge-danger" style="background-color: red; font-size: 14px;">Đã hủy đơn</span>
												<?php endif; ?>
											</td>
											<td>
											<?php if(($d-$newdate)==0 and ($result->TinhTrang)==0):?>
												<span class="badge badge-danger" style="background-color: red; font-size: 14px;">Đến hạn hợp đồng</span>
												<?php elseif(($newdate-$d)>0 and ($result->TinhTrang)==0):?>
												<span class="badge badge-danger" style="background-color: red; font-size: 14px;">Đã quá hạn hợp đồng</span>
												<?php elseif(($newdate-$d)<0):?>
												<span ></span> 
												<?php endif; ?>
											</td>
											<td><?php echo htmlentities($result->NgayNhap);?></td>
										<td><a href="manage-bookings.php" id="<?php echo htmlentities($result->id);?>" class="view_btn" type="button"data-toggle="modal"  data-target="#myModal"> Xem chi tiết</a>/ 
											<a href="edit-booking.php?id=<?php echo $result->id;?>" name="edit" id="edit" class="edit">Chỉnh sửa</a>/ 

											<a href="manage-bookings.php?aeid=<?php echo htmlentities($result->id);?>&vid=<?php echo htmlentities($result->vid);?>" onclick="return confirm('Bạn có muốn hoàn thành đơn thuê xe này?')"> Hoàn Thành</a> /
											<a href="manage-bookings.php?eid=<?php echo htmlentities($result->id);?>&vid=<?php echo htmlentities($result->vid);?>"  name="cancell" type="button" onclick="return confirm('Bạn có muốn hủy đơn thuê xe này?')"> Hủy</a>
										</td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>

									</tbody>
								</table>
								<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													<a href="add-bookings.php" class="btn btn-primary" name="submit" type="button" id="submit"style="font-size: medium;">Thêm mới</a>
												</div>


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


			$.ajax({
				type:"POST",
				url:"view-booking.php",
				data: {
					'checking_view_btn': true,
					'booking_id': b_id,
				},
				success: function(response){
					// console.log(response);
					$('.booking_viewing').html(response);
					$('#viewbookingmodal').modal('show');
				}
			});
	})
	})

</script>
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<!-- <script src="js/bootstrap-select.min.js"></script> -->
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
