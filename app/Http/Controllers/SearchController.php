<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function searchProjects(Request $request) {
//        echo count(Input::all());
//        die;
        $count = count($request->all());
        dd( $request);
        die;
        if($count > 0) {
            $query = Project::query();

            // Date Range
            if($request->has('creation-date-start') && $request->has('creation-date-end')) {
                $start = Carbon::parse($request->input('creation-date-start'));
                $end = Carbon::parse($request->input('creation-date-end'));
                $query->whereBetween('created_at', [$start, $end]);
            }
            // Code
            if($request->has('project_code')) {
                $query->where('code', $request->input('project_code'));
            }
            // Name
            if($request->has('project_name')) {
                $query->where('name', 'like', '%' . $request->input('project_name') . '%');
            }
            // Status
            if($request->has('project_status')) {
                $query->whereIn('status', $request->input('project_status'));
            }
            // PMs
            if($request->has('project_managers')) {
                $query->whereIn('project_manager', $request->input('project_managers'));
            }
            // Dev Managers
            if($request->has('dev_managers')) {
                $query->whereIn('dev_manager', $request->input('dev_managers'));
            }
            // Account Managers
            if($request->has('acct_managers')) {
                $query->whereIn('acct_manager', $request->input('acct_managers'));
            }

            $projects = $query->withCount('comments')->get();

            return $projects;
        }
        else {
            return Project::all();
        }
    }
}
