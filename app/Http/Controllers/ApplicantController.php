<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    // @desc    Store new job application
    // @route   POST /jobs/{job}/apply
    public function store(Request $request, Job $job): RedirectResponse
    {
        // Check if the user have already applied
        $existingApplication = Applicant::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($existingApplication) {
            return redirect()->back()->with("error", 'You have allready applied to this job ');
        }
        
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'required|string|email',
            'message' => 'nullable|string',
            'location' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf,docx|max:5120',
        ]);

        if ($request->hasFile('resume')) {
            $validatedData['resume_path'] = $request->file('resume')->store('resumes', 'public');
        }

        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = auth()->id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted');
    }


    // @desc     Delete job applicant
    // @route    DELETE /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return redirect()->route('dashboard')->with('success', 'Application deleted successfully');
    }
}
