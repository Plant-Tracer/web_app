<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trait;
use Auth;
use DB;

class DatabaseController extends Controller
{
    public function index(){

    	if(Auth::check()){

    		$userEmail = Auth::user()->email;
    	
    		$users = DB::table('plant_tracing')->where('researcher', '=',$userEmail)->get();

    	    $this->charts();

    		return view('database', compact('users'));
    	}

    	else{
    		return back()->with('alert', 'You must be logged in to access this page!');
    	}
    }

    	public function charts(){

			$data = \Lava::DataTable();
            $data->addDateColumn('Day of Month')
                ->addNumberColumn('Projected')
                ->addNumberColumn('Official');

            // Random Data For Example
            for ($a = 1; $a < 20; $a++)
            {
                $rowData = [
                  "2014-8-$a", rand(0.95,2.25), rand(0.95,2.25)
                ];

                $data->addRow($rowData);
            }

            \Lava::LineChart('Stocks', $data, [
              'title' => 'X-axis(Circumnutation)'
            ]);

    }
}
