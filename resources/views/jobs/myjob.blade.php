<x-layout heading="My Jobs">

    @if(count($myJobs) > 0)
    <ol>
        @foreach($myJobs as $index => $job)
            <li>
                <strong>{{ $job->title }}</strong>
                <p>Salary:{{ $job->salary }}</p>
            </li>
            <br>
        @endforeach
    </ol>
@else
    <p>No jobs found for the current user.</p>
@endif

</x-layout>