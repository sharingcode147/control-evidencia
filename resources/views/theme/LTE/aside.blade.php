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
          <li><a href="{{route('adminHome')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Opciones agrupadas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuarios</a></li>
              <li><a href="{{route('carreras.index')}}"><i class="fa  fa-graduation-cap"></i> Carreras</a></li>
              <li><a href="{{route('departamentos.index')}}"><i class="fa fa-bank"></i> Departamentos</a></li>
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
          <li><a href="{{route('colaRevisor')}}"><i class="fa fa-home"></i> <span>Cola de evidencias</span></a></li>
          <li><a href="{{route('revaprobadas')}}"><i class="fa fa-book"></i> <span>Evidencias aprobadas</span></a></li>
          <li><a href="{{route('revnoaprobadas')}}"><i class="fa fa-book"></i> <span>Evidencias no aprobadas</span></a></li>
          <li><a href="{{route('evenviadas')}}"><i class="fa fa-book"></i> <span>Evidencias enviadas a DAC</span></a></li>
        </ul>
        @endif

        <!-- DAC -->
        @if(auth()->user()->hasRole('dac'))
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">DAC</li>

          <li><a href="{{route('dacHome')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li><a href="{{route('colaDac')}}"><i class="fa fa-home"></i> <span>Cola de evidencias</span></a></li>
          <li><a href="{{route('evaprobadasdac')}}"><i class="fa fa-book"></i> <span>Evidencias aprobadas</span></a></li>

        </ul>
        @endif

        <!-- GRÁFICOS E INFORMES -->
        @if(!auth()->user()->hasRole('profesor') && !auth()->user()->hasRole('admin'))
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">GRÁFICOS E INFORMES</li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Consultas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('consulta1')}}"><i class="fa fa-circle-o"></i> Número de asistentes</a></li>
              <li><a href="{{route('consulta2')}}"><i class="fa fa-circle-o"></i>Número solicitudes profesor</a></li>
              <li><a href="{{route('consulta3')}}"><i class="fa fa-circle-o"></i>Evidencias por carrera</a></li>
              <li><a href="{{route('consulta4')}}"><i class="fa fa-circle-o"></i>Pendientes por carrera</a></li>
              <li><a href="{{route('consulta5')}}"><i class="fa fa-circle-o"></i>N°Observaciones por carrera</a></li>
              <li><a href="{{route('consulta6')}}"><i class="fa fa-circle-o"></i>N°Evidencias por alcance</a></li>
              <li><a href="{{route('consulta7')}}"><i class="fa fa-circle-o"></i>N°Evidencias por ambito</a></li>
              <li><a href="{{route('consulta8')}}"><i class="fa fa-circle-o"></i>N° de Profesores por Carerra</a></li>
              
            </ul>
          </li>
        </ul>
        @endif
      @endif

    </section>
    <!-- /.sidebar -->
  </aside>