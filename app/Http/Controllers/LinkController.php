<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShortLink;
use App\Visit;

use Auth;
use DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = ShortLink::where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(20)
        ;

        return view('Link.index')->with(['links' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $link = new ShortLink();

            $link->link = $request->link;
            $link->visited = 0;

            $short = ShortLink::generateShortedLink();

            while ( count( ShortLink::where('short', $short)->get() ) ) {
                //Obtener un nuevo codigo hasta que no se encuentre repetido
                $short = ShortLink::generateShortedLink();
            }

            $link->short = $short;
            $link->user_id = Auth::user()->id;
            $link->save();

            $this->showAlertSuccess('Registro completo');

        } catch (\Exception $ex) {
            $this->showAlertFail('Error al crear registro');
        }

        return redirect()->route('link.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = ShortLink::find($id);

        return view('Link.show')->with(['link' => $link]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = ShortLink::find($id);

        return view('Link.edit')->with(['link' => $link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $link = ShortLink::find($id);
            $link->update($request->all());

            $this->showAlertSuccess('Registro actualizado');

        } catch (\Exception $ex) {
            $this->showAlertFail('Error al actualizar registro');
        }

        return redirect()->route('link.edit', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

                $link = ShortLink::find($id);

                //Elimina las visitas
                foreach ($link->visits as $visit) {
                    $visit->delete();
                }

                //Elimina el link
                $link->delete();

                $this->showAlertSuccess('Registro eliminado');

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage());
            $this->showAlertFail('Error al eliminar registro');
        }

        return redirect()->route('link.index');
    }


    /**
     * Obtiene el conteo de visitas por mes
     *
     * Get count of visits for month
     *
     * @param $userId
     * @return JsonResponse
     */
    public function generalGraphic($userId) {

        $response = array(
            'categories' => array(),
            'data' => array()
        );

        $now = new \DateTime('now');
        $year = $now->format('Y');
        $month = $now->format('m');

        for ($x = 1; $x <= 30; $x++) {

            $date = (new \DateTime())->setDate($year, $month, $x);

            $visits = Visit::where('visits.created_at', 'like', $date->format('Y-m-d') . '%')
                ->join('short_links', 'link_id', '=', 'short_links.id')
                ->join('users', 'user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->count()
            ;

            $response['categories'][] = $x;
            $response['data'][] = $visits;
        }

        return new JsonResponse($response);
    }

    /**
     * Obtiene el conteo de visitas por mes para un link especifico
     *
     * Get count of visits for month to a especific link
     *
     * @param $userId
     * @return JsonResponse
     */
    public function linkGraphic($userId, $linkId) {

        $response = array(
            'categories' => array(),
            'data' => array()
        );

        $now = new \DateTime('now');
        $year = $now->format('Y');
        $month = $now->format('m');

        for ($x = 1; $x <= 30; $x++) {

            $date = (new \DateTime())->setDate($year, $month, $x);

            $visits = Visit::where('visits.created_at', 'like', $date->format('Y-m-d') . '%')
                ->join('short_links', 'link_id', '=', 'short_links.id')
                ->join('users', 'user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->where('short_links.id', $linkId)
                ->count()
            ;

            $response['categories'][] = $x;
            $response['data'][] = $visits;
        }

        return new JsonResponse($response);
    }
}
