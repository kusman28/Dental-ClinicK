<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treatment;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Treatment::latest('patient')->where('type', '=', 'Brace')->paginate(20);
        // return Treatment::latest()->paginate(5);
    }

    public function denture()
    {
        return Treatment::latest('patient')->where('type', '=', 'Denture')->paginate(5);
    }

    public function extraction()
    {
        return Treatment::latest('patient')->where('type', '=', 'Extraction')->paginate(5);
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
        $this->validate($request, [
            'patient' => 'required|string|max:50',
            'tooth_no' => 'string|max:15',
            'amount_charge' => 'numeric|min:100',
            'amount_paid' => 'max:100',
        ]);

        $treatment = Treatment::findOrFail($id);

        $treatment->update($request->all());
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
