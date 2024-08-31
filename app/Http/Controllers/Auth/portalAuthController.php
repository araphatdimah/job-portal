<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Portal;
use App\Models\JobOpportunity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class portalAuthController extends Controller
{
    public function index()
    {
        $portal = Portal::where('id', Auth::guard('portal')->user()->id)->first();

            $jobs_match = JobOpportunity::whereRaw("
                (
                    (category LIKE ?) + 
                    (job_style LIKE ?) + 
                    (location LIKE ?) + 
                    (required_experience LIKE ?) + 
                    (qualification LIKE ?) + 
                    (required_skills LIKE ?) +
                    (required_skills LIKE ?) +
                    (required_skills LIKE ?)
                ) >= ?
            ", [
                "{$portal->industry}",
                "{$portal->job_style}",
                "{$portal->location}",
                "{$portal->required_experience}",
                "{$portal->qualification}",
                "%{$portal->skills_set}",
                "{$portal->skills_set}%",
                "%{$portal->skills_set}%",
                3 // 50% of 6 conditions
            ])->get();
    
        return view('pages.portal', compact('jobs_match'));
    }
    public function login()
    {
        return view('pages.portal-login');
    }
    //This signs/authenticates in a user into a portal
    public function signin(Request $request)
    {
        $portal = Portal::where('email', $request->email)->first();
        if ($portal && Auth::guard('portal')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('pages.portal');
        } else {
            return redirect()->back()->withInput()->withErrors(['password' => 'Wrong email or password.']);
        }
    }
    public function register()
    {
        return view('pages.portal-register');
    }
    //This registers a new member for a portal
    public function registerMember(Request $request)
    {
        try
            {
                $request->validate([
                    'name' => ['required','string','max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:portals'],
                    'phone' => ['required', 'string', 'max:10', 'unique:portals'],
                    'qualification' => ['required', 'string'],
                    'industry' => ['required','string'],
                    'job_style' => ['required','string'],
                    'skills_set' => ['required','string'],
                    'required_experience' => ['required', 'numeric'],
                    'location' => ['required'],
                    'biography' => ['required','string'],
                    'documents' => ['nullable', 'file', 'mimes:pdf'],
                    'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                    'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()]
                ]);

                if($request->hasFile('profile_picture'))
                {
                    $file = $request->file('profile_picture');
                    $image_name = time() . '_' . $file->getClientOriginalName();
                    $image_path = '/portal profiles/' . $image_name;
                    $file->move(public_path('portal profiles'), $image_name);
                    $request->profile_picture = $image_path;
                }
                
                // Saving the business certificate PDF
                if($request->hasFile('documents'))
                {
                    $pdfFile = $request->file('documents');
                    $pdf_name = time() . '_' . $pdfFile->getClientOriginalName();
                    $pdf_path = '/portal documents/' . $pdf_name;
                    $pdfFile->move(('portal documents'), $pdf_name);
                    $request->documents = $pdf_path;
                }
                $portal = Portal::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'qualification' => $request->qualification,
                    'industry' => $request->industry,
                    'job_style' => $request->job_style,
                    'skills_set' => $request->skills_set,
                    'required_experience' => $request->required_experience,
                    'location' => $request->location,
                    'biography' => $request->biography,
                    'documents' => $request->documents,
                    'profile_picture' => $request->profile_picture,
                    'password' => Hash::make($request->password),
                ]);
                Auth::guard('portal')->login($portal);
                    return redirect()->route('pages.portal');
            }catch(\Exception $e)
            {
                return redirect()->back()->withInput()->withErrors(['name' => $e->getMessage()]);
            }
    }
    //This edits the profile of a user
    public function profilEdit(Request $request, $portalId)
    {
        
        try{
        $validated_edit_portal = $request->validate([
            'name' => ['required','regex:/^[a-zA-Z\s]+$/','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:portals,'.$portalId],
            'phone' => ['required', 'numeric', 'digits:10','unique:portals,'.$portalId],
            'qualification' => ['required', 'string'],
            'industry' => ['required','string'],
            'job_style' => ['required','string'],
            'skills_set' => ['required','string'],
            'required_experience' => ['required'],
            'location' => ['required'],
            'biography' => ['required','string']
        ]);
            $portal = Portal::find($portalId);
            if($portal){
                $updated = $portal->update($validated_edit_portal);

                if($updated)
                {
                    return response()->json(['success' => 'Profile updated successfully']);
                }
                else
                {
                    return response()->json(['status' => 'Sorry! Unable to update profile']);
                }
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'Error! '.$e->getMessage()]);
        }
    }
    //This changes the password of a user
    public function passwordChange(Request $request, $portalId)
    {
        try
        {
            $request->validate([
                'old_password' => ['required'],
                'password' => ['required', 'confirmed', Password::min(10)->numbers()->mixedCase()->symbols()->letters()]
            ]);
           $portal = Portal::where('id', $portalId)->first();
           if($portal)
           {
            if(Hash::check($request->old_password, $portal->password))
            {
                $portal->password = Hash::make($request->password);
                $password_updated = $portal->save();
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
    public function destroy(Portal $portal)
    {
        Auth::guard('portal')->logout();
        $portal->delete();
        return redirect()->route('welcome');
    }
}
