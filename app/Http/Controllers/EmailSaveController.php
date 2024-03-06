<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailSaveController extends Controller
{

    public function upload(Request $request)
    {
        //        if($request->hasFile('upload')) {
        //            $originName = $request->file('upload')->getClientOriginalName();
        //            $fileName = pathinfo($originName,PATHINFO_FILENAME);
        //            $extension = $request->file('upload')->getClientOriginalExtension();
        //            $fileName = $fileName . '_' . time() . '.' . $extension;
        //            $request->file('upload')->move(public_path('media'), $fileName);
        //
        //            $url = asset('media/' . $fileName);
        //            return response()->json(['fileName'
        //            => $fileName, 'uploaded'=> 1, 'url'=> $url]);
        //
        //
        //        }
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);

            // Get the base URL of your application (e.g., https://example.com)
            $baseUrl = url('/');

            // Construct the absolute URL to the uploaded image
            $url = 'media/' . $fileName;

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function create(Request $request)
    {

        try {
            $emailcontent101 = $request->input('content');

            $this->validate($request, [
                'content' => 'required',
            ]);

            $updatedOrCreated = EmailContent::updateOrcreate(
                ['id' => 1], // Check if a record with this 'id' exists
                [
                    'content' => $emailcontent101, // Set the 'content' attribute to the new value
                    'updated_at' => now(), // Update the 'updated_at' column with the current timestamp
                ]

            );

            if ($updatedOrCreated) {
                $emailContent = EmailContent::find(1); // Find the record with ID 1
                $rowsemail = DB::table('emailcontent')
                    ->select([
                        DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Date: [', -1), ']', 1) as date"),
                        DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Time: [', -1), ']', 1) as time"),
                        DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Zoom Link/Venue: [', -1), ']', 1) as zoom"),
                        DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Venue: [', -1), ']', 1) as venue"),
                    ])
                    ->get();

                if ($emailContent) {
                    $emailContent->updated_at = now(); // Update the 'updated_at' attribute
                    $emailContent->thisdate = $rowsemail[0]->date;
                    $emailContent->venue = $rowsemail[0]->venue;
                    $emailContent->time = $rowsemail[0]->time;
                    $emailContent->save(); // Save the updated record
                } else {
                    // If the record with ID 1 doesn't exist, create a new one

                }
                /*  flash()->addSuccess('email content saved successfully'); */
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Log the error or return an error response
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    //    public function show()
    //    {
    //        $emailcontents = EmailContent::all();
    //
    //
    //        return view('show',compact('emailcontents'));
    //    }



    //
    //    public function storeHTMLContent(Request $request)
    //    {
    //        // Retrieve the HTML content from the request
    //        $htmlContent = $request->input('html_content');
    //
    //        // Save the HTML content to your database (you can use your Eloquent model)
    //        EmailContent::updateOrcreate(
    //            ['id' => 1], // Check if a record with this 'id' exists
    //            [
    //                'content' => $htmlContent, // Set the 'content' attribute to the new value
    //                'updated_at' => now(), // Update the 'updated_at' column with the current timestamp
    //            ]
    //
    //        );
    //
    //        // Optionally, you can return a response to indicate success or failure
    //
    //     //   flash()->addSuccess('email content saved successfully');
    //    return response()->json(['message' => 'HTML content saved successfully']);
    //       // return response()->json([flash()->addSuccess('email content saved successfully'););
    //    }
}
