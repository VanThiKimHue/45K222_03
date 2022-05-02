<?php
$conn=mysqli_connect("localhost","nhchoepq_root","chothuexemaydt","nhchoepq_bikerental");
mysqli_set_charset($conn,"utf8");
if(isset($_POST['checking_view_btn']))
{
    $s_id=$_POST['booking_id'];

$sql = "SELECT khachhang.HoVaTen,khachhang.Email,khachhang.CCCD,khachhang.SoDienThoai,khachhang.DiaChi,khachhang.Quan,khachhang.ThanhPho,hangxe.TenHang,thongtinxe.TenXe,thongtinxe.Type,thongtinxe.GiaThueTheoNgay,dathang.NgayThue,dathang.NgayTra,dathang.GhiChu,dathang.idxe,dathang.idkhachhang,dathang.SoNgayThue,dathang.GiaTriHopDong,dathang.DatTruoc,dathang.ConLai,dathang.PhiKhac,dathang.TinhTrang,dathang.id  
    from dathang 
    join thongtinxe on thongtinxe.id=dathang.idxe 
    join khachhang on khachhang.id=dathang.idkhachhang 
    join hangxe on thongtinxe.HangXe=hangxe.id
    where dathang.id= $s_id";


$query_run= mysqli_query($conn, $sql);
if(mysqli_num_rows($query_run) > 0)
{  
    foreach($query_run as $row)

    {
        if($row['TinhTrang']==0){
            $tt='<span class="badge badge-primary" style="font-size: 18px;">Đã giao xe</span>';
        }else if($row['TinhTrang']==1){
            $tt='<span class="badge badge-danger" style="background-color: #007bff; font-size: 18px;">Đã trả xe và hoàn trả đầy đủ</span>';
        }else{
            $tt='<span class="badge badge-danger" style="background-color: red; font-size: 18px;">Đã hủy đơn</span>';
        }
        $t=($row['GiaTriHopDong']-$row['PhiKhac'])/$row['SoNgayThue'];
        echo $return='

        <div class="col-md-6">
            <p><b>Tên khách hàng:</b> 
            '.$row['HoVaTen'].'
            </p>
            <p><b>Email khách hàng:</b> '.$row['Email'].'</p>
            <p><b>CCCD:</b> '.$row['CCCD'].' </p>
            <p><b>Số điện thoại:</b> '.$row['SoDienThoai'].'</p>
            <p><b>Địa chỉ:</b> '.$row['DiaChi'].', '.$row['Quan'].', '.$row['ThanhPho'].'</p>
            <p><b>Ngày lấy xe:</b> '.$row['NgayThue'].'</p>
            <p><b>Ngày trả xe:</b> '.$row['NgayTra'].'</p>
            <p><b>Ghi chú:</b> '.$row['GhiChu'].' </p>
            <p><b>Tình Trạng đơn hàng:</b> '.$tt.'</p>
        </div>
        <div class="col-md-6">
            <p><b>Biển số xe:</b> '.$row['TenXe'].'</p>
            <p><b>Hãng xe:</b> '.$row['TenHang'].'</p>
            <p><b>Loại xe:</b> '.$row['Type'].'</p>
            <p><b>Giá thuê theo ngày:</b> '.$t.' VNĐ</p>
            <p><b>Số ngày thuê:</b> '.$row['SoNgayThue'].' ngày</p>
            <p><b>Tổng giá trị hợp đồng:</b> '.$row['GiaTriHopDong'].' VNĐ</p>
            <p><b>Đặt cọc:</b> '.$row['DatTruoc'].' VNĐ</p>
            <p><b>Phí khác:</b> '.$row['PhiKhac'].' VNĐ</p>
            <p><b>Thanh toán sau:</b> '.$row['ConLai'].' VNĐ</p>
        </div>


    ';


}
}
}


?>
