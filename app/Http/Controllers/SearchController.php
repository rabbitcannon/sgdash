<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    public function searchProjects() {
        $request = Request::all();
        $query = Project::query();

        // Date Range
        if(Request::has('creation-date-start') && Request::has('creation-date-end')) {
            $start = Carbon::parse($request['creation-date-start']);
            $end = Carbon::parse($request['creation-date-end']);
            $query->whereBetween('created_at', [$start, $end]);
        }
        // Code
        if(Request::has('project_code')) {
            $query->where('code', $request['project_code']);
        }
        // Name
        if(Request::has('project_name')) {
            $query->where('name', 'like', '%' . $request['project_name'] . '%');
        }
        // PMs
        if(Request::has('project_managers')) {
            $query->whereIn('project_manager', $request['project_managers']);
        }
        // Dev Managers
        if(Request::has('dev_managers')) {
            $query->whereIn('dev_manager', $request['dev_managers']);
        }
        // Account Managers
        if(Request::has('acct_managers')) {
            $query->whereIn('acct_manager', $request['acct_managers']);
        }


//        $projects = $query->with('comments')->get();
        $projects = $query->get();
//        dd($projects);

        return View::make('admin.projects.search.results', compact('projects'));
    }
}
