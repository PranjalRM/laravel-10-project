<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function store(JobRequest $request)
    {
      $req = $request->all();
      $req['user_id'] = session('user_id');
       $job = Job::create($req);
        
        return response()->json([
            'message' => 'JOb created successfully',
            'job' => $job
        ], 201); // 201 Created
    }

    public function update(Job $job,JobRequest $request)
    {
        Gate::authorize('edit-job', $job);
        //update
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),

    ]);
    return response()->json([
        'message' => 'JOb updated successfully',
    ], 201); // 201 Created
    }
}
