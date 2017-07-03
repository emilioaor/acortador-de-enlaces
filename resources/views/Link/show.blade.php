@extends('Layouts.base')

@section('content')
    <h2>Detalles</h2>
    <hr class="hr">

    <div class="row">
        <div class="col-sm-4">
            <label>Enlace</label>
            <p>{{ $link->link }}</p>
        </div>

        <div class="col-sm-4">
            <label>Acortado</label>
            <p>{{ $link->short }}</p>
        </div>

        <div class="col-sm-4">
            <label>Visitas</label>
            <p>{{ $link->visited }}</p>
        </div>
    </div>
    <a href="{{ route('link.edit', ['id' => $link->id]) }}" class="btn btn-warning">Editar <span class="glyphicon glyphicon-edit"></span></a>

    <h3>Estadisticas</h3>
    <hr class="hr">

    <div class="row">
        <div class="col-xs-12">
            <div id="spaceGraphic">
                <div class="text-center">
                    <h4>Cargando grafico ...</h4>
                    <img src="{{ asset('img/loading.gif') }}" alt="Cargando...">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/highcharts.js') }}"></script>
    <script src="{{ asset('js/mainGraphic.js') }}"></script>

    <script>
        $(window).on("load", function() {
            getData('{{ route('link.graphic.link', [
                    'userId' => Auth::user()->id,
                    'linkId' => $link->id
                ]) }}');
        });
    </script>
@endsection