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
       // $image->move(public_path('upload/portfolio'), $name_gen);



        // Resize and save the image
         // Resize, orientate, and save the image
         Image::make($image)
         ->orientate()  // Fix orientation
         ->resize(648, 616)
         ->save(public_path('upload/portfolio/' . $name_gen));

     $save_url = 'upload/portfolio/' . $name_gen;




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
    }}

    public function EditPortfolio($id){

        $portfolio = Portfolio::findOrFail($id);
        return view('admin.protfolio.protfolio_edit',compact('portfolio'));
    }// End Method


   public function UpdatePortfolio(Request $request){

        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

           // $image->move(public_path('upload/portfolio'), $name_gen);
           // $save_url = 'upload/portfolio/'.$name_gen;
            // Resize, orientate, and save the image
        Image::make($image)
        ->orientate()  // Fix orientation
        ->resize(648, 616)
        ->save(public_path('upload/portfolio/' . $name_gen));

    $save_url = 'upload/portfolio/' . $name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Portfolio Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);

        } else{

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,


            ]); 
            $notification = array(
            'message' => 'Portfolio Updated without Image Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('all.portfolio')->with($notification);

        } // end Else

     } // End Method 


     public function DeletePortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);
        Portfolio::findOrFail($id)->delete();
         $notification = array(
            'message' => 'Portfolio Image Deleted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);       
     }// End Method 
     public function PortfolioDetails($id){
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.protfolio_details',compact('portfolio'));
     }// End Method 


     public function HomePortfolio(){
       // $portfolio = Portfolio::latest()->get();
       $portfolio = Portfolio::latest()->paginate(2); // Changed to paginat
        return view('frontend.portfolio',compact('portfolio'));
        
       } // End Method 
}