<?php

namespace App\Http\Controllers;

use App\Record;
use PDF;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Record::latest('fullname')->paginate(4);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }

    public function pdfExportMedical($id){
        $record = Record::find($id);
        $pdf = PDF::loadView('pdfMedical', ['record' => $record])->setPaper('a4', 'portrait');

        $fileName = $record->name;
        return $pdf->stream($fileName . '.pdf');
    }

    public function search() {

        if ($search = \Request::get('q')) {
            $record = Record::where(function($query) use ($search){
                $query->where('fullname','LIKE',"%$search%")
                ->orWhere('created_at','LIKE',"%$search%");
            })->paginate(20);
        } else {
            $record = Record::latest()->paginate(5);
        }

        return $record;

    }
}
