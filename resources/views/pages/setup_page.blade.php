@extends('layouts.app')

@section('css')
 
@endsection


@section('content')
<div class="container-fluid" >
    <div class="row" style="margin-top: 20px;">
      @foreach ($info_user as $user)
       <div class="col-md-6">

          <!-- Profile Image -->
          <div class="box box-primary" style="background: #E6E6E6">
            <div class="box-body box-profile">
              {{-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}

              <h3 class="profile-username text-center">{{$user['name']}}</h3>

              <ul class="list-group list-group-unbordered">
                @foreach ($user['name_page'] as $page)
                <li class="list-group-item">
                  <b>{{$page['name_page']}}</b> &emsp; ViewID: <b>{{$page['view_id']}}</b> &emsp;<i style="color: gray">#utm_source={{$page['utm_source']}}&utm_medium={{$page['utm_medium']}} </i>  
                  <a href="#" class="pull-right" data-toggle="modal" data-target="#modal-delete"><button class="btn btn-danger btn-xs delete_page" data-pageid='{{$page['id']}}' data-page='{{$page['name_page']}}' data-name='{{$user['name']}}' ><i class="fa fa-trash-o"></i></button></a> {{-- //nut xóa --}}

                  <a  class="pull-right">&emsp;</a>  
                  <a href="#" class="pull-right"><button class="btn btn-primary btn-xs edit_page"  data-toggle="modal" data-target="#modal-default" data-name ='{{$page['name_page']}}' data-medium ='{{$page['utm_medium']}}' data-pageid ='{{$page['id']}}' data-source ='{{$page['utm_source']}}' data-viewid ='{{$page['view_id']}}' ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                </li>
                @endforeach
              </ul>

              <button class="btn btn-primary btn-block add_page"  data-toggle="modal" data-target="#modal-new" data-userid ='{{$user['user_id']}}'  >Thêm Trang</button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      </div>
      @endforeach
      
    </div>   
        {{-- //box chỉnh sửa --}}
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Chỉnh sửa Trang</h4>
              </div>
              <div class="modal-body">
                            <div class="box-body">
           
                  <form role="form" action="{{ route('edit_page') }}" method="POST">
                  <!-- text input -->
                  @csrf               
                  
                  <div class="form-group">
                    <label> Tên Page </label>
                    <input type="text" class="form-control"  id="edit_name" name="name_page" value="">
                    @if($errors->has('name_page'))
                    <p class="errors" style="color:red">{{$errors->first('name_page')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> VIEW ID </label>
                    <input type="text" class="form-control"  id="edit_viewid" name="view_id" value="">
                    @if($errors->has('view_id'))
                    <p class="errors" style="color:red">{{$errors->first('view_id')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> utm_source </label>
                    <input type="text" class="form-control"  id="edit_source" name="utm_source" value="">
                    @if($errors->has('utm_source'))
                    <p class="errors" style="color:red">{{$errors->first('utm_source')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> utm_medium </label>
                    <input type="text" class="form-control"  id="edit_medium" name="utm_medium" value="">
                    @if($errors->has('utm_medium'))
                    <p class="errors" style="color:red">{{$errors->first('utm_medium')}}</p>
                    @endif
                  </div>

                  <input type="hidden" id="edit_pageid" name="pageid" value="">

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
        </div> {{-- //end box--}}   

        {{-- //box Them mới --}}
        <div class="modal fade" id="modal-new">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm Trang</h4>
              </div>
              <div class="modal-body">
                            <div class="box-body">
           
                  <form role="form" action="{{ route('store_page') }}" method="POST">
                  <!-- text input -->
                  @csrf               
                  
                  <div class="form-group">
                    <label> Tên Page </label>
                    <input type="text" class="form-control"   name="name_page" value="">
                    @if($errors->has('name_page'))
                    <p class="errors" style="color:red">{{$errors->first('name_page')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>View_ID </label>
                    <input type="text" class="form-control"   name="view_id" value="">
                    @if($errors->has('view_id'))
                    <p class="errors" style="color:red">{{$errors->first('view_id')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> utm_source </label>
                    <input type="text" class="form-control"   name="utm_source" value="">
                    @if($errors->has('utm_source'))
                    <p class="errors" style="color:red">{{$errors->first('utm_source')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label> utm_medium </label>
                    <input type="text" class="form-control"  name="utm_medium" value="">
                    @if($errors->has('utm_medium'))
                    <p class="errors" style="color:red">{{$errors->first('utm_medium')}}</p>
                    @endif
                  </div>

                  <input type="hidden" id="add_userid" name="user_id" value="">

                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-success">Thêm</button>
              </div>
            </div>
            </form> 
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> {{-- //end box--}} 

        {{-- Box Xóa --}}
        <div class="modal modal-warning fade" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cảnh báo</h4>
              </div>
              <div class="modal-body">
                <p>Bạn chuẩn bị xóa trang <b id="namepage_delete"></b>  của  <b id="name_nv"></b> &emsp; Bạn có chắc chắn không??</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Hủy</button>
                 <form role="form" action="{{ route('delete_page') }}" method="POST">
                  @csrf
                  <input type="hidden" id= "delete_pageid" name="id" value="">
                <button type="sumbit" class="btn btn-outline"> Tiếp Tục Xóa</button>
                </form>
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> {{-- end box --}}
</div>
@endsection

@push('scripts')
<script>
$(function(){
        $('.edit_page').click(function(){
        var medium = $(this).data("medium");
        var name = $(this).data("name"); 
        var pageid = $(this).data("pageid"); 
        var source = $(this).data("source"); 
        var viewid = $(this).data("viewid"); 
        
        document.getElementById("edit_medium").value=(medium);
        document.getElementById("edit_name").value=(name);
        document.getElementById("edit_pageid").value=(pageid);
        document.getElementById("edit_source").value=(source);
        document.getElementById("edit_viewid").value=(viewid);
        });

         $('.add_page').click(function(){
        var userid = $(this).data("userid"); 
        document.getElementById("add_userid").value=(userid);
        });

         $('.delete_page').click(function(){
        var pageid = $(this).data("pageid");
        var name_page = $(this).data("page");
        var name_nv = $(this).data("name");
        document.getElementById("delete_pageid").value=(pageid);
        document.getElementById("namepage_delete").innerHTML =(name_page);
        document.getElementById("name_nv").innerHTML =(name_nv);
        });
});
</script>
@endpush
