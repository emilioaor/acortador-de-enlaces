@extends('Layouts.base')

@section('content')
    <h2>Registro</h2>
    <hr class="hr">

    <form action="{{ route('index.registerUser') }}" method="post">

        {{ csrf_field() }}

        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required="required">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password1">Contraseña</label>
                    <input type="password" class="form-control" id="password1" name="password[]" placeholder="Contraseña" required="required">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password2">Repetir contraseña</label>
                    <input type="password" class="form-control" id="password2" name="password[]" placeholder="Repetir contraseña" required="required">
                </div>
            </div>

        </div>

        <div class="text-center">
            <button class="btn btn-purple">Registrar <span class="glyphicon glyphicon-list"></span></button>
        </div>

    </form>
@endsection