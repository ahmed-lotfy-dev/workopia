<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Job;

class JobController extends Controller
{
    use AuthorizesRequests;
    // @desc Show jobs page form 
    // @route GET /jobs
    public function index(): View
    {
        $jobs = Job::latest()->paginate(3);
        return view("jobs.index", )->with('jobs', $jobs);
    }

    // @desc Show create page
    // @route GET /jobs/create
    public function create()
    {
        return view("jobs.create");
    }


    // @desc Save job to database 
    // @route POST /jobs/

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "salary" => "required|integer",
            "tags" => "nullable|string",
            "job_type" => "required|string",
            "remote" => "required|boolean",
            "requirements" => "nullable|string",
            "benefits" => "nullable|string",
            "address" => "nullable|string",
            "city" => "required|string",
            "state" => "required|string",
            "zipcode" => "nullable|string",
            "contact_email" => "required|string",
            "contact_phone" => "nullable|string",
            "company_name" => "required|string",
            "company_description" => "nullable|string",
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048",
            "company_website" => "nullable|url"
        ]);

        //hardcoded userid cause of missing authentication yet 

        $validatedData['user_id'] = auth()->id();

        if ($request->hasFile('company_logo')) {
            //store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');
            //add path to database
            $validatedData['company_logo'] = $path;
        }


        // submit to database 
        Job::create($validatedData);
        return redirect()->route("jobs.index")->with("success", "job listing created successfully");
    }


    // @desc Display single job listing 
    // @route GET /jobs/{$id}
    public function show(Job $job): View
    {
        return view("jobs.show")->with("job", $job);
    }


    // @desc Show edit job form 
    // @route GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {
        // Check if user authorised
        $this->authorize('update', $job);

        return view("jobs.edit")->with("job", $job);
    }


    // @desc Update single job listing 
    // @route PUT /jobs/{$id}
    public function update(Request $request, Job $job): string
    {
        // Check if user authorised
        $this->authorize('update', $job);
        $validatedData = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "salary" => "required|integer",
            "tags" => "nullable|string",
            "job_type" => "required|string",
            "remote" => "required|boolean",
            "requirements" => "nullable|string",
            "benefits" => "nullable|string",
            "address" => "nullable|string",
            "city" => "required|string",
            "state" => "required|string",
            "zipcode" => "nullable|string",
            "contact_email" => "required|string",
            "contact_phone" => "nullable|string",
            "company_name" => "required|string",
            "company_description" => "nullable|string",
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048",
            "company_website" => "nullable|url"
        ]);

        if ($request->hasFile('company_logo')) {
            // delete old image 
            if ($job->company_logo) {
                Storage::disk('public')->delete($job->company_logo);
            }
            // store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');
            // add path to database
            $validatedData['company_logo'] = $path;
        }


        // submit to database 
        $job->update($validatedData);
        return redirect()->route("jobs.index")->with("success", "job listing updated successfully!");
    }

    // @desc Delete job listing 
    // @route DELETE /jobs/{$id}
    public function destroy(Job $job)
    {
        // Check if user authorised
        $this->authorize('delete', $job);
        // if logo delete it 
        if ($job->company_logo) {
            Storage::disk("public")->delete($job->company_logo);
        }

        $job->delete();

        // check if the request coming from dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with(
                'success',
                'Job listing deleted successfully!'
            );

        }
        return redirect()->route('jobs.index')->with(
            'success',
            'Job listing deleted successfully!'
        );
    }
}
