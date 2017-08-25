<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProject;
use App\Project;
use App\EnvironmentStatus;
use App\ProjectStatus;
use App\Role;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * @return mixed
     */
    public function index() {
        $roles = Role::all();

        foreach($roles as $role) {
            if($role->name === "Development Manager")
                $dev_id = $role->id;
            if($role->name === "Account Manager")
                $acct_id = $role->id;
            if($role->name === "Project Manager")
                $proj_id = $role->id;
        }

        $data = [
            'env_statuses' => EnvironmentStatus::all(),
            'project_statuses' => ProjectStatus::all(),
            'account_managers' => User::whereHas('role', function ($query) use ($acct_id) { $query->where('role_id', '=', $acct_id); })->get(),
            'dev_managers' => User::whereHas('role', function ($query) use ($dev_id) { $query->where('role_id', '=', $dev_id); })->get(),
            'project_managers' => User::whereHas('role', function ($query) use ($proj_id) { $query->where('role_id', '=', $proj_id); })->get()
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
        $project->status = $request->input('status');
        $project->acct_manager = $request->input('acct_manager');
        $project->dev_manager = $request->input('dev_manager');
        $project->project_manager = $request->input('project_manager');
        $project->trend = $request->input('trend_create');
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
        } else {
            $req = Carbon::parse($request->req_eta);
        }

        Project::where('id', $id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'status' => $request->status,
            'acct_manager' => $request->input('acct_manager'),
            'dev_manager' => $request->input('dev_manager'),
            'project_manager' => $request->input('project_manager'),
            'trend' => $request->input('trend'),
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

    public function delete($id) {
        \DB::table('projects')->where('id', $id)->delete();

        return Redirect::to('/admin/projects');
    }
}
