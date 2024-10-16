<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Image;
class PortfolioController extends Controller
{
    public function AllPortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('admin.protfolio.protfolio_all',compact('portfolio'));
    } // End Method
    public function AddPortfolio(){
        return view('admin.protfolio.protfolio_add');
    } // End Method
    

    public function StorePortfolio(Request $request)
{
    $request->validate([
        'portfolio_name' => 'required',
        'portfolio_title' => 'required',
        'portfolio_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'portfolio_name.required' => 'Portfolio Name is Required',
        'portfolio_title.required' => 'Portfolio Title is Required',
    ]);

    if ($request->file('portfolio_image')) {
        $image = $request->file('portfolio_image');

        // Generate a unique filename
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        // Move the file to the public directory
        $image->move(public_path('upload/portfolio'), $name_gen);

        $save_url = 'upload/portfolio/' . $name_gen;

        // Insert data into the database
        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        // Notification message
        $notification = [
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.portfolio')->with($notification);
    } else {
        // Handle the case if no image is uploaded (optional)
        $notification = [
            'message' => 'Portfolio Image is Required',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notification);
    }
} // End Method

}