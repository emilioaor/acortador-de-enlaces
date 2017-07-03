@extends('Layouts.base')

@section('content')
    <h2>Acortador de enlaces</h2>
    <hr class="hr">
    <p>
        ¿Estas cansado de esos largos links imposibles de entender?. Utiliza ShorterLinkEO para acortar tus enlaces a una estructura mas comprensible y además podrás hacer seguimiento a las visitas que recibes en cada uno.
    </p>
    <p>
        Utilizar esta estadísticas es una manera eficaz de medir el trafico que te genera cada uno de tus links y con esto hacer modificaciones en tu estrategia de negocio.
    </p>

    <div class="row" id="how-to">
        <div class="col-sm-4 text-center">
            <h3>Acorta</h3>
            <p><span class="glyphicon glyphicon-scissors"></span></p>
        </div>

        <div class="col-sm-4 text-center">
            <h3>Comparte</h3>
            <p><span class="glyphicon glyphicon-share"></span></p>
        </div>

        <div class="col-sm-4 text-center">
            <h3>Monitorea</h3>
            <p><span class="glyphicon glyphicon-eye-open"></span></p>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <form action="{{ route('index.login') }}" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required="required">
                </div>

                <div class="text-center">
                    <button class="btn btn-purple">Entrar</button>
                </div>

            </form>

        </div>

    </div>
@endsection