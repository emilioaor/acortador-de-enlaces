@extends('Layouts.base')

@section('content')
    <h2>Panel de administración</h2>
    <hr class="hr">

    <div class="row">

        <div class="col-sm-8 col-sm-offset-2">

            <form action="{{ route('link.store') }}" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" id="newLink" class="form-control" name="link" placeholder="http://www.enlace.com" required="required">
                </div>
            </form>

        </div>

    </div>

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

    <br>
    <h4>Mis enlaces</h4>
    <hr class="hr">
    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <th width="40%">Original</th>
                <th width="30%">Acortado</th>
                <th width="10%">Visitas</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($links as $link)
                <tr>
                    <td><a href="{{ $link->link }}" target="_blank" rel="nofollow">{{ str_limit($link->link, 30) }}</a></td>
                    <td><a href="{{ 'http://' . $_SERVER['HTTP_HOST'] . '/' . $link->short }}" target="_blank">{{ 'http://' . $_SERVER['HTTP_HOST'] . '/' . $link->short }}</a></td>
                    <td>{{ $link->visited }}</td>
                    <td>
                        <a href="{{ route('link.show', ['id' => $link->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a>
                        <a href="{{ route('link.edit', ['id' => $link->id]) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                        <button type="button" onclick="deleteLink('{{ route('link.destroy', ['id' => $link->id]) }}')" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {!! $links->render() !!}
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-danger"><strong>ATENCION!</strong></h5>
                    <p>En el momento que elimine este enlace <strong>perderá toda la estadistica</strong> registrada y recuerde que esta acción no se puede deshacer. ¿Seguro desea eliminar?</p>

                    <form action="#" id="formDelete" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="form-group text-center">
                            <button class="btn btn-danger">Si</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </form>
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
            getData('{{ route('link.graphic.general', ['userId' => Auth::user()->id]) }}');
        });
    </script>
@endsection