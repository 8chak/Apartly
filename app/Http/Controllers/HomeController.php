<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Gallery;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Contact;
use Carbon\CarbonPeriod;
use App\Mail\UserMessage;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    
    public function index() {
        $user = Auth::user();
        if($user->user_type === 'admin'){
            // dd($user);
            return view('admin.dashboard');
        }elseif($user->user_type === 'user'){
            return view('theme.index');
        }
        return redirect()->back();
    }

    public function hotel_index() {
        $rooms = Room::paginate(6);
        $galleries = Gallery::paginate(8);
        $blogs = Blog::paginate(3);
        return view('theme.index', compact(['rooms', 'galleries', 'blogs']));
    }
    public function all_rooms() {
        $rooms = Room::all();
        return view('theme.allrooms', compact('rooms'));
    }

    public function show_room(Room $room){
        $bookings = Booking::where('room_id', $room->id)
                   ->where('end_date', '>', now())
                   ->get();

        
                   // Calculating....           
        $bookedDates = [];
        foreach ($bookings as $booking) {
            $period = CarbonPeriod::create($booking->start_date, $booking->end_date->subDay());
            
            foreach ($period as $date) {
                $bookedDates[] = $date->format('Y-m-d');
            }
        }
        // Remove duplicates
        $bookedDates = array_unique($bookedDates);

        return view('theme.room-details', compact('room', 'bookedDates'));
    }

    public function blogpage() {
        $blogs = Blog::all();
        return view('theme.blog-page', compact('blogs'));
    }

    public function viewPost($id) {
        $blog = Blog::findOrFail($id);
        return view('theme.view-post', compact('blog'));
    }

    public function store_message(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $contact = Contact::create($validated);

         // Send email
        Mail::to('e.procashchakraborty@gmail.com')->send(new UserMessage($contact));

        return redirect()->back()->with('success', "Your message was sent successfully.");

    }

    public function contact_page() {
        return view('theme.contact-page');
    }

}
