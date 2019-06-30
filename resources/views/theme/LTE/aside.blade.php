  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset("img/logo_ucm.png")}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Universidad Católica</p>
          <p>del Maule</p>
        </div>
      </div>
      @if(Auth::check())
        <!-- ADMINISTRADOR -->
        @if(auth()->user()->hasRole('admin'))
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">ADMINISTRADOR</li>
          <li><a href="#"><i class="fa fa-book"></i> <span>Opción</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Opciones agrupadas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op1</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op2</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op3</a></li>
            </ul>
          </li>
        </ul>
        @endif

        <!-- PROFESOR -->
        @if(auth()->user()->hasRole('profesor'))
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">PROFESOR</li>
          <li><a href="{{route('profeHome')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li><a href="{{route('get_carreras')}}"><i class="fa fa-book"></i> <span>Nueva Evidencia</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Evidencias en curso</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('evidenciasC_revisor')}}"><i class="fa fa-circle-o"></i>En Revisor</a></li>
              <li><a href="{{route('evidenciasC_Dac')}}"><i class="fa fa-circle-o"></i>En DAC</a></li>
            </ul>
          </li>
          <li><a href="{{route('evaprobadas')}}"><i class="fa fa-check-circle"></i> <span>Evidencias aprobadas DAC</span></a></li>
          <li><a href="{{route('evnoaprobadas')}}"><i class="fa fa-ban"></i> <span>Evidencias no aprobadas</span></a></li>
        </ul>
        @endif

        <!-- REVISOR -->
        @if(auth()->user()->hasRole('revisor'))
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">REVISOR</li>
          <li><a href="{{route('revisorHome')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li><a href="{{route('revaprobadas')}}"><i class="fa fa-book"></i> <span>Evidencias aprobadas</span></a></li>
          <li><a href="{{route('revnoaprobadas')}}"><i class="fa fa-book"></i> <span>Evidencias no aprobadas</span></a></li>
          <li><a href="{{route('evenviadas')}}"><i class="fa fa-book"></i> <span>Evidencias enviadas a DAC</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Opciones agrupadas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op1</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op2</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op3</a></li>
            </ul>
          </li>
        </ul>
        @endif

        <!-- DAC -->
        @if(auth()->user()->hasRole('dac'))
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">DAC</li>
          <li><a href="{{route('dacHome')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Opciones agrupadas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op1</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op2</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> sub op3</a></li>
            </ul>
          </li>
        </ul>
        @endif
      @endif

    </section>
    <!-- /.sidebar -->
  </aside>