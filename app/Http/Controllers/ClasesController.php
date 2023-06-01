<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Clases;
use Illuminate\Pagination\Paginator;

class ClasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DB::select('SELECT * FROM clases');
        $count = count($query);
        $perPage = 5;
        $page = $request->page ?? 1;
        $offset = ($page - 1) * $perPage;

        $data = array_slice($query, $offset, $perPage, true);
        $data = new LengthAwarePaginator($data, $count, $perPage, Paginator::resolveCurrentPage(), [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
        return $data;
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
        $input = $request->all();

        $clase = Clases::create($input);

        $data = $clase->toArray();

        return response()->json($data, 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        /*
            "clase": "test",
	"dia": "Martes",
	"begin": "10:00:00",
	"ends": "11:00:00"
        */

        $edit = Clases::findOrFail($id);
        $edit->clase = $request->clase;
        $edit->dia = $request->dia;
        $edit->begin = $request->begin;
        $edit->ends = $request->ends;

        $edit->save();

        return $edit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clase = Clases::findOrFail($id);
        $clase->delete();
        return $clase;
    }

}
