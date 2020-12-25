@extends('layouts.app')

@section('css')

@endsection


@section('content')
<div class="container">

    <div class="row" style="margin-top: 20px;">

      <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"> Chọn nhân viên thống kê </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('setup_user')}}" method="POST">
              @csrf
              <div class="box-body">
                @foreach ($users as $user)
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" {{$user['check']}} name="users[]" value="{{$user['id']}}"> {{$user['name']}}
                  </label>
                </div>
                @endforeach
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Xác Nhận</button>
              </div>
            </form>
          </div>
      </div>

      <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Chọn Trang thống kê </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('setup_page')}}" method="POST">
              @csrf
              <div class="box-body">
                
                @foreach ($pages as $page)
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" {{$page['check']}} name="pages[]" value="{{$page['id']}}"> {{$page['name_page']}}
                  </label>
                </div>
                @endforeach
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Xác Nhận</button>
              </div>
            </form>
          </div>
      </div>

    </div>

</div>
@endsection


@push('scripts')

@endpush
