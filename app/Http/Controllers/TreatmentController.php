<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treatment;
use App\Patient;
use App\Record;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Treatment::latest('fullname')->where('type', '=', 'Brace')->paginate(5);
        // return Treatment::latest()->paginate(5);
    }

    public function denture()
    {
        return Treatment::latest('fullname')->where('type', '=', 'Denture')->paginate(5);
    }

    public function extraction()
    {
        return Treatment::latest('fullname')->where('type', '=', 'Extraction')->paginate(5);
    }

    public function allPatient()
    {
       return Treatment::latest('patient')->paginate(10);
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
        // return Treatment::create([
        //     'patient' => $request['patient'],
        //     'tooth_no' => $request['tooth_no'],
        //     'type' => $request['type'],
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $wew = Treatment::findOrFail($id);

        return $wew;

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
        $treatment = Treatment::findOrFail($id);

        $this->validate($request, [
            'fullname' => 'required|string|max:50',
            'tooth_no' => 'string|max:15',
            'procedure' => 'string|max:200',
            'amount_charge' => 'numeric|min:100',
            'amount_paid' => 'max:100',
            'balance' => 'max:100',
            'status' => 'max:100',
        ]);

        $treatment->fullname = $request->input('fullname');
        $treatment->status = $request->input('status');
        $treatment->tooth_no = $request->input('tooth_no');
        $treatment->procedure = $request->input('procedure');
        $treatment->amount_charge = $request->input('amount_charge');
        $treatment->amount_paid = $request->input('amount_paid');
        $treatment->balance = ((int)$treatment->amount_charge - (int)$treatment->amount_paid);

        $treatment->update();

        // Awn bug dii
        return Record::create([
            'patient_id' => $request['id'],
            'fullname' => $request['fullname'],
            'tooth_no' => $request['tooth_no'],
            'procedure' => $request['procedure'],
        ]);

        // $treatment->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
