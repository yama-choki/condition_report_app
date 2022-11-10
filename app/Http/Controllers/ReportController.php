<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $orderedReports = Report::orderBy('created_date', 'desc')->get();
        $groupedReports = $orderedReports->groupBy('created_date');
        return view('reports.index', compact('user','groupedReports'));
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
        $rules = [
            'temperature' => 'required|numeric|',
            'text' => 'max:100'
          ];

          $messages = [
            'required' => '体温は必須項目です',
            'numeric' => '体温は数値を入力してください。',
        ];

          Validator::make($request->all(), $rules, $messages)->validate();

        $report = new Report;

        $report->condition = $request->input('condition');
        $report->temperature = $request->input('temperature');
        $report->family = $request->input('family');
        $report->text = $request->input('text');
        $report->user = $request->input('userName');

        $report->save();

        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selectedReports= Report::where('created_date', '=', $id)->get();
        $userNames = User::select('name')->get();

        $selectedReportsUsers=[];
        foreach($selectedReports as $selectedReport){
            $selectedReportsUsers[] = $selectedReport->user;
        };
        // dd($selectedReportsUsers);
        $isPostedUser = true;
        return view('reports.show', compact('selectedReports', 'selectedReportsUsers', 'userNames', 'isPostedUser'));
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
        //
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
