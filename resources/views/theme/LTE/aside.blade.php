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

      <!-- REVISOR -->
      @if(auth()->user()->hasRole('revisor'))
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REVISOR</li>
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

      <!-- DAC -->
      @if(auth()->user()->hasRole('dac'))
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DAC</li>
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


    </section>
    <!-- /.sidebar -->
  </aside>