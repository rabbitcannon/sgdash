<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['req_eta', 'dev_eta', 'qa_eta', 'uat_eta', 'prod_eta'];

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'acct_manager', 'dev_manager', 'project_manager', 'trend',
        'req_status', 'req_eta', 'dev_status', 'dev_eta', 'qa_status', 'qa_eta', 'uat_status', 'uat_eta', 'prod_status', 'prod_eta'];


    /**
     * @param $id
     * @return mixed
     */
    public function getEnvStatus($id) {
        $status = EnvironmentStatus::where('id', $id)->first();
        return $status;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProjectStatus($id) {
        $status = ProjectStatus::where('id', $id)->first();
        return $status;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function accountManager() {
        return $this->hasOne('App\User');
    }
}
