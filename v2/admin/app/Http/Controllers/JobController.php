<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\UserCustom;

class JobController extends Controller {

    public function __construct() {
        
    }

    /*
     * create job action
     */

    public function create($id) {
        return view('jobs.create-job', ['company_id' =>$id]);
    }

    /*
     * view details action
     */

    public function details($id) {
        return view('jobs.job-details', ['job_id' =>$id]);
    }

    /*
     * matching jobs action
     */

    public function matching_jobs() {
        return view('jobs.matching-jobs');
    }

    /*
     * matching candidates action
     */

    public function matching_candidates() {
        return view('jobs.matching-candidates');
    }

}
