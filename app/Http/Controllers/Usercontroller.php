<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function register(Request $req)
    {
        $alumni = 'alumni';

        $user= new User;
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->work=$req->input('work');
        $user->location=$req->input('location');
        $user->linkedin=$req->input('linkedin');
        $user->bio=$req->input('bio');
        $user->role=$alumni;
        $user->password=Hash::make($req->input('password'));
        $user->save();

        return $user;
    }

    function addjob(Request $req)
    {
        $stat = 'pending';

        $job= new Job;
        $job->position=$req->input('position');
        $job->company=$req->input('company');
        $job->location=$req->input('location');
        $job->details=$req->input('details');
        $job->link=$req->input('link');
        $job->status=$stat;
        $job->requestedBy=$req->input('requestedBy');
        $job->save();

        return $job;
    }

    function login(Request $req)
    {

        $credentials = $req->only('email','password');

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;
            $cookie = cookie('token', $token, 60); 

            return response()->json([
                'id' => $user->id,
                'name' => $user->name, 
                'email' => $user->email, 
                'location' => $user->location, 
                'linkedin' => $user->linkedin, 
                'work' => $user->work, 
                'bio' => $user->bio, 
                'batch' => $user->batch, 
                'journal' => $user->journal, 
                'role' => $user->role,
                'token' => $token])->withCookie($cookie);
                
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }


    function logout(Request $req)
    {
        Auth::logout();
        

        return response()->json(['message' => 'Logged out successfully']);

        // return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function show()
    {
        $user = Auth::user(); // Retrieve the logged-in user using the Auth facade
    
        // Check if a user is authenticated
        if ($user) {
            // Return the user data as a JSON response
            return response()->json($user);
        } else {
            // Return an error response if no user is authenticated
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function getUserData(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
        ]);
    }

    function dashboard(Request $req)
    {
        return "Welcome admin";
    }

    
    function alumnidashboard(Request $req)
    {
        return "Welcome User";
    }

    function dashboard_profile(Request $req)
    {
        return "Welcome Rawr";
    }


    // UPDATE

    // UPDATE USER DETAILS
    public function updateUserDetails(Request $request)
    {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id' => 'required',
                'work' => 'required',
                'linkedIn' => 'required',
                'bio' => 'required',
                'batch' => 'required',
                'journal' => 'required',
            ]);
    
            // Get the user ID from the request
            $userId = $validatedData['id'];
    
            // Find the user by ID
            $user = User::findOrFail($userId);
    
            // Update the user details
            $user->work = $validatedData['work'];
            $user->linkedIn = $validatedData['linkedIn'];
            $user->bio = $validatedData['bio'];
            $user->batch = $validatedData['batch'];
            $user->journal = $validatedData['journal'];
    
            // Save the updated user details
            $user->save();
    
            // Return a response indicating success
            return response()->json(['message' => 'User details updated successfully']);
          
    }



}

        // $credentials = $req->only('email', 'password');
    
        // if (!Auth::attempt($credentials)) {
        //     return response()->json(['error' => 'Email or password is not matched'], 401);
        // }
    
        // $user = Auth::user();
    
        // return $user;


        // $email = $req->input('email');
        // $password =  $req->input('password');

        // $user = DB::table('users')->where('email', $email)->first();

        // if(!Hash::check($password, $user->password))
        // {
        //     echo "Not matched";
        // }
        // else{
        //     echo $user->name;
        // }
