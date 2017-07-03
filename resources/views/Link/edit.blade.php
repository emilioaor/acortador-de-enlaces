@extends('Layouts.base')

@section('content')
    <h2>Editar</h2>
    <hr class="hr">

    <form action="{{ route('link.update', ['id' => $link->id]) }}" method="post">

        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Enlace</label>
                    <input type="text" class="form-control" name="link" value="{{ $link->link }}" required="required">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Acortado</label>
                    <input type="text" class="form-control" name="short" value="{{ $link->short }}" required="required" readonly="readonly">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Visitas</label>
                    <input type="text" class="form-control" name="visited" value="{{ $link->visited }}" required="required" readonly="readonly">
                </div>
            </div>
        </div>

        <button class="btn btn-success">Actualizar <span class="glyphicon glyphicon-save"></span></button>
        <a href="{{ route('link.show', ['id' => $link->id]) }}" class="btn btn-primary">Detalles <span class="glyphicon glyphicon-search"></span></a>
    </form>
@endsection