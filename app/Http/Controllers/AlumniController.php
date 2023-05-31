<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $alumniListings = User::where('role', 'alumni')->get();

        return response()->json($alumniListings);
    }
}
