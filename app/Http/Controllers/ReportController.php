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
        $loginUser = Auth::user();
        $loginUserId = $loginUser->id;
        $orderedReports = Report::latest()->get();
        $groupedReports = $orderedReports->groupBy('created_date');
        $latestReport = Report::where('id', '=', $loginUserId)->latest()->limit(1)->get();

        // dd($loginUser,$loginUserId,$groupedReports,$latestReport);
        return view('reports.index', compact('loginUser','groupedReports','latestReport'));
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
            'temperature' => 'required|numeric|max:40',
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
        $report->user_name = $request->input('name');
        $report->user_id = $request->input('userId');

        $report->save();

        return to_route('reports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loginUser = Auth::user();
        $selectedReports= Report::where('created_date', '=', $id)->get();
        $userNames = User::select('name')->get();

        $selectedReportsUsers=[];
        foreach($selectedReports as $selectedReport){
            $selectedReportsUsers[] = $selectedReport->user;
        };
        return view('reports.show', compact('selectedReports', 'selectedReportsUsers', 'userNames', 'loginUser'));
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
        Report::find($id)->delete();

        return to_route('reports.index');
    }
}
