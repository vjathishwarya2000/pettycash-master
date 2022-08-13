<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PettyCash;


class PettyCashController extends Controller
{
    public function index()
    {
        $pettycash = PettyCash::orderBy('date', 'ASC')->get();
        $amountTotal = $pettycash->sum('amount');
        $stationaryTotal = PettyCash::where('type', 'stationary')->sum('amount');
        $travellingTotal = PettyCash::where('type', 'travelling')->sum('amount');
        $postageTotal = PettyCash::where('type', 'postage')->sum('amount');
        $othersTotal = PettyCash::where('type', 'others')->sum('amount');

        return view('home',compact('pettycash', 'amountTotal', 'stationaryTotal', 'travellingTotal', 'postageTotal', 'othersTotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'description' => 'required| max:20',
            'amount' => 'required',
            'type' => 'required',
        ]);
        $input = $request->all();

        PettyCash::create($input);

        return redirect('/')->with('status', 'Transaction added successfully');
    }

    public function delete($id)
    {
        $transaction = PettyCash::find($id);
        $transaction->delete();

        return redirect('/')->with('deleted', 'Record has been deleted');
    }
}
