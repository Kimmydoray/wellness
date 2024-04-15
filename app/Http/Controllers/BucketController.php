<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;

class BucketController extends Controller
{
    // Get DATA
    public function index(Request $request) {
        // Retrieve data from your model
        $query = Bucket::query();
        
        // Apply search filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }
        if ($request->filled('bucket')) {
            $bucket = $request->input('bucket');
            $query->where('bucket', '=', "$bucket");
        }

        // Fetch filtered data
        $data = $query->get();

        // Calculate the total number of data
        $total = $data->count();

        // Calculate the sum of values in the 'value' column
        $totalValue = $data->sum('value');

        // Return the data, total number, and total value in an associative array
        return view('wellness', [
            'data' => $data,
            'total' => $total,
            'totalValue' => $totalValue
        ]);
       
    }

    // Search Data
    public function getDataWithTotal(Request $request)
    {
        // Retrieve data from your model
        $query = Bucket::query();

        // Apply search filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        // Fetch filtered data
        $data = $query->get();

        // Calculate the total number of data
        $total = $data->count();

        // Calculate the sum of values in the 'value' column
        $totalValue = $data->sum('value');

        // Return the data, total number, and total value in an associative array
        return [
            'data' => $data,
            'total' => $total,
            'total_value' => $totalValue,
        ];
    }

    //ADD Data
    public function handleFormSubmission(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'bucket' => $request->input('bucket'),
            'value' => $request->input('value'),
        ];
        // var_dump($data);die;
        Bucket::create($data);
        // Process the data as needed

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
