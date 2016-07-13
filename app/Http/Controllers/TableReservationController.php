<?php

namespace App\Http\Controllers;

use App\Drink;
use App\Meal;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Table;
use App\TableReservation;
use App\TableReservationType;
use Carbon\Carbon;

class TableReservationController extends Controller
{
    //
    public function index()
    {
        return view('diner')->with([
            'meals' => Meal::all(),
            'drinks' => Drink::all(),
            'types' => TableReservationType::all()
        ]);
    }

    public function show(Table $table)
    {

    }

    public function store(Request $request)
    {

        $tables = $this->getPossibleTables($request->people);

        $date  = explode('-' , $request->date);
        $time = explode(':', $request->time);
        $arrival = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
        $departure = $arrival->copy()->addHour(TableReservationType::find($request->type)->hours);

        //  Check reservations for each possible table
        foreach ($tables as $table){
            if($this->isAvailable($table, $arrival, $departure)){
                $reservation = new TableReservation();
                $reservation->user_id = \Auth::user()->id;
                $reservation->name = $request->name;
                $reservation->table_id = $table->id;
                $reservation->people = $request->people;
                $reservation->reservation_type_id= $request->type;
                $reservation->arrival = $arrival;
                $reservation->departure = $departure;
                $reservation->save();
                return redirect()->action('UserController@profile');
            }
        }
        return redirect()->back()->withInput();
    }
    //  Checks all reservations for table
    //  Returns true if the table is available for giver period
    //  Returns false if table is booked
    public function isAvailable($table, $arrival, $departure)
    {
        //return true;
        $reservations = $table->reservations;

        foreach ($reservations as $reservation) {

            $arrivalB = Carbon::parse($reservation->arrival);
            $departureB = Carbon::parse($reservation->departure);

            if($departure->between($arrivalB, $departureB))
                return false;
            elseif($arrival->between($arrivalB, $departureB))
                return false;
        }

        return true;

    }

    //Get possible tables
    //Returns tables number of people < > people + 3 (max 3 unused seats per table)
    public function getPossibleTables($people)
    {
        return Table::whereBetween('people', [$people, $people+3])
            ->orderBy('people', 'asc')->get();

    }

    public function create()
    {
        return view('table-reservation')->with('types', TableReservationType::all());
    }

    public function edit(Table $table)
    {

    }

    public function update(Request $request, Table $table)
    {

    }

    public function destroy(Table $table)
    {

    }
}