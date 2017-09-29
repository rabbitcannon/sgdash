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
    protected $dates = ['req_eta', 'dev_eta', 'qa_eta', 'uat_eta', 'prod_eta', 'deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'status', 'acct_manager', 'dev_manager', 'project_manager', 'trend',
        'req_status', 'req_eta', 'dev_status', 'dev_eta', 'qa_status', 'qa_eta', 'uat_status', 'uat_eta', 'prod_status', 'prod_eta', 'deleted_at'
    ];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('App\Comment', 'project_id');
    }

//    public function scopeProjectStatus($query, $array) {
//        return $query->whereIn('status', $array);
//    }
}
