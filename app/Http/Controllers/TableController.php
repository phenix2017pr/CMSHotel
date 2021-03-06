<?php

namespace App\Http\Controllers;

use App\TableReservation;
use App\TableReservationType;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Table;

class TableController extends Controller
{
    //
    public function index($sort = 'name', $order = 'asc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';

        return view('admin.tables.index')->with([
            'tables' => Table::orderBy($sort,$order)->get(),
            'types' => TableReservationType::all(),
            'order' => $toggle
        ]);
    }
    
    public function store(Request $request)
    {
        $table = new Table();
        $table->name = $request->name;
        $table->people = $request->people;

        $table->save();
        return redirect()->action('TableController@index');
    }

    public function update(Request $request, Table $table)
    {
        $table->name = $request->name;
        $table->people = $request->people;

        $table->update();
        return redirect()->action('TableController@index');
    }

    public function destroy(Table $table)
    {
        $table = Table::destroy($table->id);
        return response()->json($table);
    }

}
