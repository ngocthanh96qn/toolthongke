
    <li class="header bg-cus">CHỨC NĂNG</li>

    <li class="active">
      <a href="{{ route('menu.setup_info') }}">
        <i class="fa fa-users"></i>
        <span> QL THÔNG TIN NV</span>
      </a>
    </li>
  
    <li class="active">
      <a href="{{ route('menu.setup_page') }}">
        <i class="fa fa-flag"></i>
        <span> QL Page NV</span>
      </a>
    </li>

    {{-- <li class="active">
      <a href="#">
        <i class="fa fa-money"></i>
        <span>QUẢN LÍ LƯƠNG </span>
      </a>
    </li> --}}

    {{-- <li class="active">
      <a href="#">
        <i class="fa fa-video-camera"></i>
        <span> THỐNG KÊ TEAM AB</span>
      </a>
    </li> --}}

    {{-- <li class="active">
      <a href="{{ route('menu.analytic_nv') }}">
        <i class="fa fa-bolt"></i>
        <span> THỐNG KÊ TEAM IA</span>
      </a>
    </li> --}}
    
    <li class="active">
      <a href="{{ route('setup_total') }}">
        <i class="fa fa-cog"></i>
        <span> CÀI ĐẶT THỐNG KÊ </span>
      </a>
    </li>
    <li class="active">
      <a href="{{ route('menu.analytic_total') }}">
        <i class="fa fa-line-chart"></i>
        <span> XEM THỐNG KÊ TEAM IA </span>
      </a>
    </li>
    {{-- <li class="active">
      <a href="{{ route('menu.teamAb') }}">
        <i class="fa fa-line-chart"></i>
        <span>XEM THỐNG KÊ TEAM AB </span>
      </a>
    </li> --}}
    <li class="active">
      <a href="{{ route('clear_cache') }}">
        <i class="fa fa-trash-o"></i>
        <span> Clear Cache </span>
      </a>
    </li>