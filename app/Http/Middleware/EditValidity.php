<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EditValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            $jobid = $request->route('job')->id;
            $job = Job::select('id', 'user_id')->where('id', $jobid)->first();

            if ($request->session()->get('user_id') == $job->user_id) {
                return $next($request);
            }
            return redirect()->route('jobpage');
    }
}
