<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProject;
use App\Projects;
use App\ProjectStatus;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Redirect;

class ProjectsController extends Controller
{
    /**
     * @return mixed
     */
    public function index() {
        $data = [
            'statuses' => ProjectStatus::all(),
            'account_managers' => User::whereHas('role', function ($query) { $query->where('role_id', '=', 7); })->get()
        ];

        return View::make('admin.projects.index', $data);
    }

    /**
     * @return mixed
     */
    public function show() {
        $data = [
            'projects' => Project::all(),
        ];

        return View::make('projects.index', $data);
    }

    /**
     * @param CreateProject $request
     * @return mixed
     */
    public function create(CreateProject $request) {
        $project = new Project();

        $project->created_by = Auth::user()->id;
        $project->code = $request->input('project_code');
        $project->name = $request->input('project_name');
        $project->acct_manager = $request->input('acct_manager');
        $project->trend = $request->input('trend');
        $project->req_status = $request->input('req_status');
        $project->req_eta = Carbon::parse($request->input('req_eta'));
        $project->dev_status = $request->input('dev_status');
        $project->dev_eta = Carbon::parse($request->input('dev_eta'));
        $project->qa_status = $request->input('qa_status');
        $project->qa_eta = Carbon::parse($request->input('qa_eta'));
        $project->uat_status = $request->input('uat_status');
        $project->uat_eta = Carbon::parse($request->input('uat_eta'));
        $project->prod_status = $request->input('prod_status');
        $project->prod_eta = Carbon::parse($request->input('prod_eta'));
        $project->save();

        return Redirect::to('/admin/projects');
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function update($id, Request $request) {
        if($request->req_eta === null) {
            $req = null;
        }
        else {
            $req = Carbon::parse($request->req_eta);
        }

        Project::where('id', $id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'req_eta' => $req,
            'req_status' => $request->req_status,
            'dev_eta' => Carbon::parse($request->dev_eta),
            'dev_status' => $request->dev_status,
            'qa_eta' => Carbon::parse($request->qa_eta),
            'qa_status' => $request->qa_status,
            'uat_eta' => Carbon::parse($request->uat_eta),
            'uat_status' => $request->uat_status,
            'prod_eta' => Carbon::parse($request->prod_eta),
            'prod_status' => $request->prod_status,
        ]);
    }
}
