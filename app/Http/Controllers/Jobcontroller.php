<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Mail\Jobposted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use App\Http\Requests\JobRequest;

class Jobcontroller extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function owner()
    {
    $userId = auth()->id(); 
    $myJobs = Job::where('user_id', $userId)->get(); 

    return view('jobs.myjob', compact('myJobs'));
    }
     
    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store(JobRequest $request)
    {
      $req = $request->all();
      $req['user_id'] = session('user_id');
       $job = Job::create($req);
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job,JobRequest $request)
    {
        Gate::authorize('edit-job', $job);
        //update
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),

    ]);
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
         Gate::authorize('edit-job', $job);
    
         $job->delete();

        return redirect('/jobs');
    }
}
