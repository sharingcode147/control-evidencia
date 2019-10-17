
@extends('theme.LTE.layout')

@section('content')

<div class="col-md-2"></div>

<div class="col-md-8 ">
  <div class="box box-success"> 

    <div class="box-header with-border">
      <h3 class="box-title">Verificar folio</h3>
    </div>

    <div class="box-body">
      <form method="POST" action="{{route('existeFolio')}}">
        @csrf
        <div class="form-group">

          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <label>Código</label>
                <input name="folioString" type="text" class="form-control" placeholder="Código">
              </div>
              <div class="col-xs-6">
                <label>Número</label>
                <input name="folioNum" type="text" class="form-control" placeholder="Número">
              </div>
            </div>
          </div>
          
        </div>
        <button type="submit" class="btn btn-primary">Verificar</button>
    </form>
    </div>

    

  </div>
  @if(Session::has('noExiste'))
    <div class="col-md-12 alert alert-danger" role="alert">
        <button class='close' data-dismiss="alert">
            &times;
        </button>
        {{Session::get('noExiste')}}
    </div>
@endif
</div>


            


@endsection

@section('scripts')
@endsection