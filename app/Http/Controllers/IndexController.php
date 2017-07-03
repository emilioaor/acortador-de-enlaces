<?php

namespace App\Http\Controllers;

use App\ShortLink;
use Illuminate\Http\Request;

use App\User;
use App\Visit;
use Auth;
use DB;

/**
 * Clase para cargar vistas principales
 *
 * Class to load main views
 *
 * Class IndexController
 * @package App\Http\Controllers
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class IndexController extends Controller
{

    /**
     * Vista principal
     * Main view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('Index.index');
    }

    /**
     * Autentica al usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('link.index');
        }

        $this->showAlertFail('Datos invalidos');

        return redirect()->route('index.index');
    }

    /**
     * Logout de usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();

        return redirect()->route('index.index');
    }

    /**
     * Carga vista de registro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register() {
        return view('Index.register');
    }

    public function registerUser(Request $request) {

        if ($request->password[0] !== $request->password[1]) {
            $this->showAlertFail('Las contraseña deben ser iguales');

            return redirect()->route('index.register');
        }

        $user = User::where('email', $request->email)->get();

        if (count($user)) {
            $this->showAlertFail('Este email ya esta siendo usado');

            return redirect()->route('index.register');
        }

        try {
            $user = new User($request->all());
            $user->password = bcrypt($request->password[0]);
            $user->save();

            $this->showAlertSuccess('Usuario registrado correctamente');

            return redirect()->route('index.index');
        } catch (\Exception $ex) {
            $this->showAlertFail('Ocurrio un error al registrar usuario');
        }

        return redirect()->route('index.register');
    }

    /**
     * Redirecciona al link real y suma una visita al contador
     * @param $short
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function visit($short) {

        $link = ShortLink::where('short', $short)->get();

        if (! count($link)) {
            $this->showAlertFail('Disculpe, enlace no encontrado');
            return redirect()->route('index.index');
        }

        try {
            DB::beginTransaction();

                $link[0]->visited++;
                $link[0]->save();

                $visit = new Visit();

                $visit->link_id = $link[0]->id;
                $visit->save();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            error_log('Error al procesar link : ' . $short);
        }

        return redirect($link[0]->link);
    }
}
