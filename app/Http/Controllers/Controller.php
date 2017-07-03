<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Crea una alerta satisfactoria
     * @param $message
     */
    public function showAlertSuccess($message) {
        Session::flash('alert-type', 'alert-success');
        Session::flash('alert-msg', $message);
    }

    /**
     * Crea una alerta fallida
     * @param $message
     */
    public function showAlertFail($message) {
        Session::flash('alert-type', 'alert-danger');
        Session::flash('alert-msg', $message);
    }
}
