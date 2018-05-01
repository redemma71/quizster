<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs;

class JobsController extends Controller
{
    public function getJobs() {
        return Jobs::all();
    }

    public function logJob(Request $request) {
        $job = Jobs::create($request->all());
        return response()->json($job, 201);
    }

    public function searchJobs() {
        $searchString = $_POST['search_string'];
        $searchString = trim($searchString);
        $job = Jobs::where(function ($query) use ($searchString) {
            // cast $searchString to lowercase
            // do regex search on $searchString 
            $query->where('jobName', 'like', '%' . $searchString . '%')
            ->orWhere('jobDescription', 'like', '%' . $searchString . '%');
        })->get();
        return json_encode($job);
    }


}
