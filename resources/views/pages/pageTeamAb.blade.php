@extends('layouts.app')

@section('css')
  {{-- chen css --}}
  <!-- DataTables -->
  <link rel="stylesheet" href={{asset("admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href={{asset("admin-lte/dist/css/skins/_all-skins.min.css")}}>
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection


@section('content')
<div class="container">
    
	<div class="row" style="margin-top:30px;">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <button data-toggle="modal" data-target="#modal-danger" type="button" id="add" class="btn btn-block btn-success btn-sm">THÊM PAGE MỚI</button>
        </div>
    </div>
    
     <div class="row" style="margin-top:10px;">
           <div class="col-md-12" style="margin-top:10px">
          <div class="box-header">
              <h4 class="box-title" style="color: #ffffff">Vào đây lấy Token: <a href="https://developers.facebook.com/tools/explorer/" class="btn btn-success" target="_blank">Click</a></h4>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
           <div class="col-md-12">
          <div class="box-header">
              <h4 class="box-title" style="color: #ffffff">Lấy token dài hạn: <br> oauth/access_token?grant_type=fb_exchange_token&client_id=<i style="color: #123421">thaythongso</i>&client_secret=<i style="color: #123421">thaythongso</i>&fb_exchange_token=<i style="color:#123421">thaythongso</i></h4>
            </div>
        </div>
    </div>
     
    <div class="row" style="margin-top:30px;"> {{-- Cột Bảng token --}}

        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Theo dõi view  ( tự nhiên | có phí )</h3>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Page</th>
                  <th>Tiếp cận hôm qua</th>
                  <th>Tiếp cận hôm trước</th>
                  <th>Tiếp cận 28 ngày qua</th>
                  <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
               @foreach ($data_page as $key => $page)
                 <tr>
                   <td>{{$key+1}}</td>
                   <td>{{$page['name']}}</td>
                   <td>{{$page['yesterday']['not_paid']}} &emsp;|&emsp;{{$page['yesterday']['paid']}}   </td>
                   <td>{{$page['BeforeYesterday']['not_paid']}}&emsp;|&emsp;{{$page['BeforeYesterday']['paid']}}</td>
                   <td>{{$page['28days']['not_paid']}}&emsp;|&emsp;{{$page['28days']['paid']}}</td>
                   <td  data-toggle="modal" data-target="#modal-dangerdelete" > <button class="btn btn-danger btn-xs delete_page" data-id='{{$page['id']}}'><i class="fa fa-trash-o"></i></button> </td>
                 </tr>
                 
               @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          
        </div>
    </div> {{--End Cột Bảng token --}}
    <div class="modal modal-danger fade" id="modal-dangerdelete">
            <!-- modal-dialog -->
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cảnh báo</h4>
              </div>
              <div class="modal-body">
                <p>Bạn chuẩn bị xóa toàn bộ dữ liệu của nhân viên này!&emsp; Bạn có chắc chắn không??</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Hủy</button>
                 <form role="form" action="{{ route('delete_pageAB') }}" method="POST">
                  @csrf
                  <input type="hidden" id= "delete_id" name="id" value="">
                <button type="sumbit" class="btn btn-outline"> Tiếp Tục Xóa</button>
                </form>
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
         </div>
    <div class="modal modal-success fade" id="modal-danger">
            <!-- modal-dialog -->
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm Trang</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{ route('add_page') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label> TOKEN </label>
                    <input type="text" class="form-control" placeholder='' name="token" value="">
                  </div>
               	  <div class="form-group">
                    <label> Id Page </label>
                    <input type="text" class="form-control" placeholder='' name="id_page" value="">
                  </div>
                  <div class="form-group">
                    <label> Name Page </label>
                    <input type="text" class="form-control" placeholder='' name="name_page" value="">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Hủy</button>
                  <button type="sumbit" class="btn btn-outline"> Thêm Trang</button>
                </form>
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
         </div>   
</div>
@endsection


@push('scripts')
        <!-- DataTables -->
<script src={{asset("admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}></script>
<!-- SlimScroll -->
<script src={{asset("admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}></script>
<!-- FastClick -->
<script src={{asset("admin-lte/bower_components/fastclick/lib/fastclick.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{asset("admin-lte/dist/js/demo.js")}}></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
$(function(){

    

        $('.delete_page').click(function(){
        var id = $(this).data("id");
         document.getElementById("delete_id").value=(id);
         });
        
        
});
</script>
@endpush
