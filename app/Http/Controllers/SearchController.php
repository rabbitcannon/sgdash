<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function searchProjects(Request $request) {
//        var_dump($request->all());die;
//        var_dump(Input::get('dev_managers[]'));die;
        $query = Project::query();

            // Date Range
        if($request->has('creation-date-start') && $request->has('creation-date-end')) {
            $start = Carbon::parse($request->input('creation-date-start'));
            $end = Carbon::parse($request->input('creation-date-end'));
            $query->whereBetween('created_at', [$start, $end]);
        }
        // Code
        if($request->has('project_code')) {
            $query->orWhere('code', $request->input('project_code'));
        }
        // Name
        if($request->has('project_name')) {
            $query->orWhere('name', 'like', '%' . $request->input('project_name') . '%');
        }
        // Status
        if($request->has('project_status') && !empty($request->input('project_status'))) {
            $query->whereIn('status', $request->input('project_status'));
        }
        // PMs
        if($request->has('project_managers') && !empty($request->input('project_managers'))) {
            $query->whereIn('project_manager', $request->input('project_managers'));
        }
        // Dev Managers
        if($request->has('dev_managers') && !empty($request->input('dev_managers'))) {
            $query->whereIn('dev_manager', $request->input('dev_managers'));
        }
        // Account Managers
        if($request->has('account_managers') && !empty($request->input('account_managers'))) {
            $query->whereIn('acct_manager', $request->input('account_managers'));
        }

        $projects = $query->withCount('comments')->get();

        return $projects;
    }
}
