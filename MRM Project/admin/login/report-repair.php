<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}else{
    $date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d",strtotime(date("Y-m-d")." -7 days")) ;
    $date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d") ;
    $ex = isset($_GET['xethue']) ? $_GET['xethue'] :  "" ;
    if ($ex!="")
    {
        
        $bike1= "and suachua.idxe=$ex";
    }else
    {
        
        $bike1="";
    }
    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = ' VNĐ') {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
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

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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
small, .small {
    font-size: 95%;
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

						<h2 class="page-title">Báo cáo chi phí sữa chữa</h2>
            </div>
            <form id="filter-form">
            
            <!-- <div class="row"> -->
                <div class="form-group col-md-3">
                    <label for="date_start">Ngày bắt đầu</label>
                    <input type="date" class="form-control form-control-sm" name="date_start" value="<?php echo date("Y-m-d",strtotime($date_start)) ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_start">Ngày kết thúc</label>
                    <input type="date" class="form-control form-control-sm" name="date_end" value="<?php echo date("Y-m-d",strtotime($date_end)) ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="bike">Xe</label>
                    <select class="form-control" name="xethue" id="xethue"  >
                        <option value=""> Tất cả xe </option>
                        <?php $ret="select id,TenXe from thongtinxe";
                        $query= $dbh -> prepare($ret);
                        $query-> execute();
                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                        if($query -> rowCount() > 0)
                        { 
                        foreach($results as $result)
                        { 
                            
                        ?>
                        <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TenXe);?></option>
                        <?php }} ?>

                        </select>
                </div>
                <div class="form-group col-md-1">
                <label >Xem báo cáo</label>
                    <button class="btn btn-flat btn-block btn-primary"><i class="fa fa-filter"></i> Lọc</button>
                </div>
<?php 
if ($ex!="")
{
    $sql="select TenXe from thongtinxe where id=$ex";
    $query= $dbh -> prepare($sql);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
        foreach($results as $result){
        }
    }
    $b=$result->TenXe;
}else
{
    $b="tất cả xe";
}
?>
        </form>
        </div>
            <div class="row">
            <h4 class="panel-heading text-center text-bold">Báo cáo chi phí của <?php echo htmlentities($b);?></h4>
            </div>
        
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">

                            
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">

                                    <thead>
                                            <tr>
                                            <th>#</th>
                                                <th>Biển Số Xe</th>
                                                <th>Ghi Chú</th>
                                                <th>Ngày Phát Sinh</th>
                                                <th>Chi phí</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                                <th>Biển Số Xe</th>
                                                <th>Ghi Chú</th>
                                                <th>Ngày Phát Sinh</th>
                                                <th>Chi phí</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                    <?php $sql = "SELECT thongtinxe.TenXe,suachua.*
                                    from suachua 
                                    join thongtinxe on thongtinxe.id=suachua.idxe 
                                    where date(suachua.NgayNhap) between '{$date_start}' and '{$date_end}' $bike1";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    $total=0;
                                    if($query->rowCount() > 0)
                                    { 

                                    foreach($results as $result)
                                    {		$total=$total+$result->SoTien;	?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td>
                                            <?php echo htmlentities($result->TenXe) ?>
                                        </td>
                                        <td> <?php echo htmlentities($result->GhiChu) ?></td>
                                        <td> <?php echo date('Y-m-d',strtotime($result->NgayNhap)) ?></td>
                                        <td><?php echo htmlentities($result->SoTien);?></td>
                                    </tr>

                                    <?php $cnt=$cnt+1; }} ?>

                                    </tbody>
                                    </table>
                                    <form class="form-horizontal">
                                <div class="form-group">
                                            <label class="col-sm-5 control-label" style="color: #B20600; font-size: 18px">Tổng chi phí</label>
                                            <div class="col-sm-2">
                                                <input class="form-control"  value="<?php echo currency_format($total);?>" readonly>
                                                
                                            </div>
					            </div>
                                </form>  
							</div>
						</div>



			</div>
		</div>
	</div>
    
    </script>
	<!-- Loading Scripts -->
	<script src="js/bootstrap-select.min.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="js/jquery.dataTables.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script src="js/jautocalc.js"></script>
	<script src="js/script.js"></script>
    <script>
    $(function(){
        $('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "report-repair.php?date_start="+$('[name="date_start"]').val()+"&date_end="+$('[name="date_end"]').val()+"&xethue="+$('[name="xethue"]').val()
        })
    })
    </script>
    	<script>
		$("#xethue").chosen();
    </script>
</body>
</html>
<?php } ?>