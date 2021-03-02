<!DOCTYPE html>
<html>
<head>
	<title>Input Data</title>
	
  <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top: 30px">
	            <form role="form" action="{{ route('add_data_ab') }}" method="POST">
                  @csrf               
                  

                	<table>
					    <tr>
					      <th>Ngày</th>
					      @foreach ($pages as $page)
					      	<th>{{$page['page_name']}}</th>
					      @endforeach
					      
					    </tr>
					    @foreach ($days as $key=>$day)
					    <tr>
					    	<td>
					      	<div class="form-group">
                    		<input type="text" class="form-control" placeholder='{{$day}}'  >
                  			</div> 
              			    </td>
					    	@foreach ($pages as $page)
					    	<td>
					      	<div class="form-group">
                    		<input type="text" class="form-control" placeholder='' name="traffic/{{$day}}/{{$page['id']}}" >
                  			</div> 
              			    </td>
					    	@endforeach 
					    </tr>
					    @endforeach
					    
					    
					</table>
				<div class="box-footer text-center">
                  <button type="submit" class="btn btn-success"> Nhập dữ liệu </button>
                </div>
                </form>
 </div>

</body>
</html>