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
    <div class="row">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <button type="button" id="add" class="btn btn-block btn-success btn-sm">THÊM TRANG</button>
        </div>
    </div>

        <div class="row" id="view_add">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">THÊM TRANG</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           
                    <form role="form" action="{{ route('store_pagecheck') }}" method="POST">
                  <!-- text input -->
                  @csrf               
                  
                  
                  <div class="form-group">
                    <label> TÊN </label>
                    <input type="text" class="form-control" placeholder="" name="name" value="{{old('name')}}">
                    @if($errors->has('name'))
                    <p class="errors" style="color:red">{{$errors->first('name')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> UserName </label>
                    <input type="text" class="form-control" placeholder=''name="page" value="{{old('page')}}">
                    @if($errors->has('page'))
                    <p class="errors" style="color:red">{{$errors->first('page')}}</p>
                    @endif
                  </div> 
                  
                  <div class="box-footer">
                <label id="cancel_add" class="btn btn-default">HỦY</label>
                <button type="submit" class="btn btn-success pull-right">THÊM</button>
              </div>          
                </form>          
      
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="row" style="margin-top:30px;"> {{-- Cột Bảng token --}}
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">CÁC TRANG ĐANG THEO DÕI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên</th>
                  <th>UserName</th>
                  <th>Chỉnh sửa</th>
                  <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
               @foreach ($data as $key => $info)
                 <tr>
                   <td>{{$key+1}}   </td>
                   <td>{{$info['name']}}   </td>
                   <td>{{$info['page']}}</td>
                   <td> <button class="btn btn-primary btn-xs edit_info"  data-toggle="modal" data-target="#modal-default"  data-name ='{{$info['name']}}' data-page ='{{$info['page']}}'  data-id='{{$info['id']}}' ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>

                   <td  data-toggle="modal" data-target="#modal-danger" > <button class="btn btn-danger btn-xs delete_info" data-id='{{$info['id']}}'><i class="fa fa-trash-o"></i></button> </td>
                 </tr>
                 
               @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <div class="modal modal-danger fade" id="modal-danger">
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
                 <form role="form" action="{{ route('delete_pagecheck') }}" method="POST">
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
         {{-- //// --}}
         <div class="modal modal-warning fade" id="modal-danger1">
            <!-- modal-dialog -->
            <!-- /.modal-content -->
          </div>

          <!-- /.modal-dialog -->
        </div>
        {{-- //// --}}
          <!-- /.box -->
          <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Chỉnh sửa thông tin</h4>
              </div>
              <div class="modal-body">
                  <div class="box-body">          
                  <form role="form" action="{{ route('edit_pagecheck') }}" method="POST">
                  <!-- text input -->
                  @csrf                                 
                  <div class="form-group">
                    <label> TÊN </label>
                    <input type="text" class="form-control"  id="edit_name" name="name" value="{{old('name')}}">
                    @if($errors->has('name'))
                    <p class="errors" style="color:red">{{$errors->first('name')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> UserName </label>
                    <input type="text" class="form-control" id="edit_page" name="page" value="{{old('page')}}">
                    @if($errors->has('page'))
                    <p class="errors" style="color:red">{{$errors->first('page')}}</p>
                    @endif
                  </div> 
                 <input type="hidden" id="edit_userid" name="userid" value="">   
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-success">Lưu</button>
              </div>
            </div>
            </form> 
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> {{-- //end--}}
        </div>
        <!-- /.col -->
    </div> {{--End Cột Bảng token --}}
    
           
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

    $('#view_add').hide();
    $('.edit_row').hide();
    $('#add').click(function(){
        $('#view_add').show('slow');  
        $('#add').hide('slow');  
    });
    $('#cancel_add').click(function(){
        $('#view_add').hide('slow'); 
        $('#add').show('slow');  
    });

    var parent = document.querySelector('#view_add'),child = document.querySelector('.errors');
    if (parent.contains(child)) {
        $('#view_add').show();  
        $('#add').hide();
    }

        $('.edit_info').click(function(){
        var name = $(this).data("name"); 
        var page = $(this).data("page"); 
        var userid = $(this).data("id");
        document.getElementById("edit_name").value=(name);
        document.getElementById("edit_page").value=(page);
        document.getElementById("edit_userid").value=(userid);
        });

        $('.delete_info').click(function(){
        var userid = $(this).data("id");
         document.getElementById("delete_id").value=(userid);
         });
        
});
</script>
@endpush
