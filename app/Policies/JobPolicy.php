<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
       public function edit(User $user, Job $job): bool
       {
              return $user->id ==$job->employer_id;
       }
}
