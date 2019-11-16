<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;

use App\Treatment;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Patient::latest()->paginate(25);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:15',
            'middlename' => 'required|string|max:15',
            'lastname' => 'required|string|max:15',
            'age' => 'required|numeric|max:99',
            'address' => 'required|string|max:50',
            'contact_no' => 'required|string|max:11',
        ]);

        Treatment::create([
            'patient' => $request['firstname'].' '.$request['middlename'].' '.$request['lastname'],
            'type' => $request['type'],
        ]);

        return Patient::create([
            'fullname' => $request['firstname'].' '.$request['middlename'].' '.$request['lastname'],
            'firstname' => $request['firstname'],
            'middlename' => $request['middlename'],
            'lastname' => $request['lastname'],
            'age' => $request['age'],
            'address' => $request['address'],
            'contact_no' => $request['contact_no'],
            'type' => $request['type'],
        ]);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'firstname' => 'required|string|max:15',
            'middlename' => 'required|string|max:15',
            'lastname' => 'required|string|max:15',
            'age' => 'required|numeric|max:99',
            'address' => 'required|string|max:50',
            'contact_no' => 'required|string|max:11',
        ]);

        // Theres a bug in treatment table for patient name.

        $user = Patient::findOrFail($id);

        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $patient = Patient::findOrFail($id);
        $patientGroup = Patient::where('id', $patient->id)->get();
        \DB::table('treatments')->whereIn('id', $patientGroup->pluck('id'))->delete();
        Patient::where('id', $patient->id)->delete();

        // $patient = Patient::findOrFail($id);

        // $patient->delete();

        return ['message' => 'Patient deleted.'];

        // $patient = Patient::findOrFail($id);

        // $patientGroups = Patient::where('id', $patient->id)->get();
        // foreach ($patientGroups as $patietnGroup) {
        //     \DB::table('treatments')->where('id', $patietnGroup->id)->delete();
        // }

        // Patient::where('id', $patient->id)->delete();

        // return response()->json([
        //     "error" => "0",
        //     "message" => "Success"
        // ]);
    }
}
