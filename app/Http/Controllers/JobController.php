<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::all();
        return view("jobs.index", )->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
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
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max2048",
            "company_website" => "nullable|url"
        ]);

        //hardcoded userid cause of missing authentication yet 
        $validatedData["user_id"] = 1;

        if ($request->hasFile('company_logo')) {
            //store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');
            //add path to database
            $validatedData['company_logo'] = $path;
        }


        // submit to database 
        Job::create(attributes: $validatedData);
        return redirect()->route("jobs.index")->with("success", "job listing created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view("jobs.show")->with("job", $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        return view("jobs.edit")->with("job", $job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job): string
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
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max2048",
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
        $job->update(attributes: $validatedData);
        return redirect()->route("jobs.index")->with("success", "job listing updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        // if logo delete it 
        if($job->company_logo) {
            Storage::disk("public")->delete($job->company_logo);
        }

        $job->delete();
        return redirect()->route('jobs.index')->with(   'success','Job lisiting deleted successfully!');
    }
}
