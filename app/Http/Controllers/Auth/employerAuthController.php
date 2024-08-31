<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\JobOpportunity;
use App\Models\Portal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use PDF;

class employerAuthController extends Controller
{
    public function index()
    {
        $employer = Auth::guard('employer')->user();

        $actively_recruiting = JobOpportunity::where('employer_id', $employer->id)->get();

        // Fetching all job opportunities that match the employer's industry, location, and skills set etc
        $employer_job_match_seekers = Portal::where(
            function ($query) use ($employer, $actively_recruiting)
                {
                $query->where('industry', 'like', "%{$employer->industry}%")
                    ->orWhere('location', 'like', "%{$employer->location}%");
            
                foreach ($actively_recruiting as $job) {
                    $query->orWhere('skills_set', 'like', "%{$job->required_skills}%")
                        ->orWhere('job_style', 'like', "%{$job->job_style}%")
                        ->orWhere('qualification', 'like', "%{$job->qualification}%")
                        ->orWhere('required_experience', 'like', "%{$job->required_experience}%");
                }
            })->get();        

        return view('pages.employer-portal', compact('actively_recruiting', 'employer_job_match_seekers'));
    }

    //This returns the register's view for an employer/company
    public function register()
    {
        return view('pages.employer-register');
    }
    //This returns the employer login page
    public function login()
    {
        return view('pages.employer-login');
    }
    //This authorizes and logs in an employer
    public function signin(Request $request)
    {
        $employer = Employer::where('email', $request->email)->first();
        if ($employer && Auth::guard('employer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('pages.employer-portal');
        } else {
            return redirect()->back()->withInput()->withErrors(['password' => 'Wrong email or password.']);
        }
    }
    public function addJobOpportunity(Request $request)
    {
        try
        {
        // Validation for the job opportunity form
            $validate_new_job = $request->validate([
            'title' => ['required','string','max:255'],
            'category' => ['required','string'],
            'job_style' => ['required','string'],
            'location' => ['required','string'],
            'salary' => ['required','numeric'],
            'required_experience' => ['required','string'],
            'required_skills' => ['required','string'],
            'qualification' => ['required','string'],
            'description' => ['required','string'],
            'deadline' => ['required','date'],
            'cover_image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);
         // Saving the company profile image if exists
         if($request->hasFile('cover_image'))
         {
             $file = $request->file('cover_image');
             $image_name = time() . '_' . $file->getClientOriginalName();
             $image_path = '/jobs/' . $image_name;
             $file->move(public_path('jobs'), $image_name);
             $validate_new_job['cover_image'] = $image_path;
         }
        // Create the job opportunity
        $job_opportunity_create = JobOpportunity::create(array_merge($validate_new_job,
        [
        ['employer_id' => Auth::guard('employer')->user()->id],
        ['employer_name' => Auth::guard('employer')->user()->name],
        ['employer_email' => Auth::guard('employer')->user()->email],
        ['employer_phone' => Auth::guard('employer')->user()->phone],
        ]));
        if($job_opportunity_create)
        {
            return response()->json(['status' => 'Job Opportunity added successfully']);
        }
        else
        {
            return response()->json(['status' => 'Error! Unable to add job opportunity']);
        }
        }catch(\Exception $e)
            {
                return response()->json(['status' => 'Error! '.$e->getMessage()]);
            }
    }

    //This register a new employer/company
    public function registerCompany(Request $request)
    {
        try
            {
                 $request->validate([
                    'name' => ['required','string','max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:employers'],
                    'phone' => ['required', 'digits:10', 'unique:employers'],
                    'location' => ['required', 'string'],
                    'address' => ['required', 'string'],
                    'industry' => ['required', 'string'],
                    'website' => ['nullable', 'string'],
                    'description' => ['required', 'string'],
                    'buz_cert' => ['required', 'file', 'mimes:pdf'],
                    'company_profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                    'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()]
                ]);
                
                // Saving the company profile image if exists
                if($request->hasFile('company_profile'))
                {
                    $file = $request->file('company_profile');
                    $image_name = time() . '_' . $file->getClientOriginalName();
                    $image_path = '/employer profiles/' . $image_name;
                    $file->move(public_path('employer profiles'), $image_name);
                    $request->company_profile = $image_path;
                }
                
                // Saving the business certificate PDF
                if($request->hasFile('buz_cert'))
                {
                    $pdfFile = $request->file('buz_cert');
                    $pdf_name = time() . '_' . $pdfFile->getClientOriginalName();
                    $pdf_path = '/buz_certs/' . $pdf_name;
                    $pdfFile->move(('buz_certs'), $pdf_name);
                    $request->buz_cert = $pdf_path;

                // Generate a PDF document for the job opportunity
                // $pdf = PDF::loadView('pdf.job-opportunity', compact('job_opportunity_create'));
                // $pdf->save(storage_path('app/public/job-opportunities/'. $job_opportunity_create->id. '.pdf'));
                // // Attach the PDF to the job opportunity
                // $job_opportunity_create->pdf = '/job-opportunities/'. $job_opportunity_create->id. '.pdf';
                // $job_opportunity_create->save();
                }

                $employer = Employer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'location' => $request->location,
                    'address' => $request->address,
                    'industry' => $request->industry,
                    'website' => $request->website,
                    'description' => $request->description,
                    'buz_cert' => $request->buz_cert,
                    'company_profile' => $request->company_profile,
                    'password' => Hash::make($request->password),
                ]);
                Auth::guard('employer')->login($employer);
                return redirect()->route('pages.employer-portal');
            }
        catch(\Exception $e)
            {
                return redirect()->back()->withInput()->withErrors(['name' => $e->getMessage()]);
            }
    }
    //This edits the profile of an employer
    public function profilEdit(Request $request, $employerId)
    {
        $validated_edit_employer = $request->validate([
            'name' => ['required','string'],
            'email' => ['required', 'email', 'unique:employers, email,'.$employerId],
            'phone' => ['required'],
            'education' => ['required'],
            'expertise' => ['required'],
        ]);
        try{
            $employer = Employer::find($employerId);
            if($employer){
                $updated = $employer->update($validated_edit_employer);

                if($updated)
                {
                    return response()->json(['status' => 'User, '. "'{$employer->name}'".'updated successfully']);
                }
                else
                {
                    return response()->json(['status' => 'Sorry! Unable to update user']);
                }
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'Error! '.$e->getMessage()]);
        }
    }
    //This changes the password of an employer
    public function passwordChange(Request $request, $employerId)
    {
        try
        {
            $request->validate([
                'old_password' => ['required'],
                'password' => ['required', 'confirmed', Password::min(10)->numbers()->mixedCase()->symbols()->letters()]
            ]);
           $employer = Employer::where('id', $employerId)->first();
           if($employer)
           {
            if(Hash::check($request->old_password, $employer->password))
            {
                $employer->password = Hash::make($request->password);
                $password_updated = $employer->save();
                if($password_updated)
                {
                  return response()->json(['status' => 'Password updated successfully']);
                }
                else
                {
                    return response()->json(['status' => 'Sorry! Password update has failed. Try again']);
                }
            }
            else
            {
                return response()->json(['status' => 'Old password was wrong']);
            }
           }
           else
           {
            return response()->json(['status' => 'Sorry! User not found']);
           }
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 'Error! '.$e->getMessage()]);
        }
    }
    //This destroys and deletes a login user
    public function destroy(Employer $employer)
    {
        Auth::guard('employer')->logout();
        $employer->delete();
        return redirect()->route('welcome');
    }
    //This deletes a job opportunity
    public function delete(Employer $employer, $employerId)
    {
        $job = $employer->job()->find($employerId);
        $job->delete();
        return redirect()->route('pages.employer')->with('status', 'Job,'. "'{$job->title}'". 'deleted successfully');
    }
}
