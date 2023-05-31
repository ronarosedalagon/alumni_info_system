<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobListings = Job::all();

        return response()->json($jobListings);
    }

    public function userIndex()
    {
        $jobListings = Job::where('status', 'Approved')->get();

        return response()->json($jobListings);
    }

    public function approveJob(Request $request, $id)
    {
        try {
            $jobListing = Job::findOrFail($id);
            $jobListing->status = 'Approved';
            $jobListing->save();

            // You can perform any additional actions or updates here

            return response()->json(['message' => 'Job status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating job status'], 500);
        }
    }
    public function declineJob(Request $request, $id)
    {
        try {
            $jobListing = Job::findOrFail($id);
            $jobListing->status = 'Decline';
            $jobListing->save();

            // You can perform any additional actions or updates here

            return response()->json(['message' => 'Job status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating job status'], 500);
        }
    }
}
