<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Blog;
use App\Models\Contact;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function rooms_index() {
        $rooms = Room::all();
        return view('admin.rooms-index', compact('rooms'));
    }
    
    public function create_room() {
        $user = Auth::user();
        if(!$user || !$user->type === 'admin'){
            return redirect()->back()->with('error', 'Unauthorized Access.');
        }
        return view('admin.create-room');
    }

    public function store_room(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rent' => 'required|numeric|min:0',
            'type' => 'required|string',
            'facility' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 2MB max
        ]);
        
        // Handle image upload
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $path = $image->store('rooms', 'public');
        //     $validated['image'] = $path;
        // }
        // Handle image upload
        if($request->hasFile('image')){
            $image = $request->file('image');
            
            // Generate a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Move to public/images/rooms
            $image->move(public_path('storage/images/rooms'), $filename);
            
            // Store the path in database
            $validated['image'] = 'images/rooms/' . $filename;
        }

        Room::create($validated);
        
        return redirect()->back()->with('success', 'Room created successfully.');
    }

    public function edit_room(Room $room) {
        return view('admin.edit-room', compact('room'));
    }
    public function update_room(Room $room, Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rent' => 'required|numeric|min:0',
            'type' => 'required|string',
            'facility' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 2MB max
        ]);
        // Handle image upload
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $path = $image->store('rooms', 'public');
        //     $validated['image'] = $path;
        // }
        // Handle image upload
        if($request->hasFile('image')){
            $image = $request->file('image');
            
            // Generate a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Move to public/images/rooms
            $image->move(public_path('storage/images/rooms'), $filename);
            
            // Store the path in database
            $validated['image'] = 'images/rooms/' . $filename;

            //delete old one
            if($room->image){
                File::delete(public_path($room->image));
            }
        }

        $room->update($validated);
        return redirect()->route('roomsIndex')->with('success', 'Room Updated successfully.');
    }
    public function destroy_room(Room $room) {
        // Delete image file if exists
        // if ($room->image && Storage::exists('public/storage/' . $room->image)) {
        //     Storage::delete('public/storage/' . $room->image);
        // }
        //delete old one
        if($room->image){
            File::delete(public_path('storage/'.$room->image));
        }

        $room->delete();
        
        return redirect()->back()->with('success', 'Room deleted successfully');
    }

    //
    public function index_bookings() {
        $bookings = Booking::with('user')->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function update_booking(Request $request, Booking $booking) {
        $request->validate([
            'status' => 'required|in:waiting,confirmed,checked_in,checked_out,cancelled',
        ]);
        
        $booking->update([
            'status' => $request->status
        ]);
        
        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    public function index_gallery() {
        $images = Gallery::all();
        return view('admin.gallery', compact('images'));
    }

    public function store_gallery( Request $request ) {
        // dd($request->data);
        $validated = $request->validate([
            'image_title' => 'nullable|string|max:255',
            'image' => 'required|file|mimes:jpeg,jpg,png,gif,webp|max:2048', // max size in KB
        ]);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imagePath = $image->store('gallery', 'public'); // stores in storage/app/public/gallery
            // $imageName = time() . '_' . $image->getClientOriginalName();
            // Or use storeAs for custom name
            // $imagePath = $image->storeAs('gallery', $imageName, 'public');
            // Generate a unique, safe filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Move to public/images/rooms
            $image->move(public_path('storage/images/gallery'), $filename);

            $imagePath = 'images/gallery/' . $filename;


            // Save to database
            Gallery::create([
                'image_title' => $validated['image_title'],
                'image' => $imagePath,
            ]);
            
            return redirect()->back()->with('success', 'Image added to gallery successfully!');
        }
        
        return redirect()->back()->with('error', 'No image uploaded');

    }

    public function gallery_destroy($id){
        $gallery_image = Gallery::findOrFail($id);

        if($gallery_image->image){
            File::delete(public_path('storage/'.$gallery_image->image));
        }

        $gallery_image->delete();

        return redirect()->back()->with('success', "Gallery Image deleted Successfully.");
    }

    public function create_post() {
        return view('admin.create-post');
    }

    public function posts_index() {
        $blogs = Blog::all();
        return view('admin.posts-index', compact('blogs'));
    }

    public function create_post_store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'status' => 'required|in:draft,published,scheduled',
        ]);
        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        //// Handle image upload
        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request->file('image')->store('posts', 'public');
        // }
        // Handle image upload
        if($request->hasFile('image')){
            $image = $request->file('image');
            
            // Generate a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Move to public/images/rooms
            $image->move(public_path('storage/images/posts'), $filename);
            
            // Store the path in database
            $validated['image'] = 'images/posts/' . $filename;
        }
        // Create post
        Blog::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function posts_edit(Blog $blog) {
        return view('admin.edit-post', compact('blog'));
    }

    public function post_update(Request $request, Blog $blog) {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'status' => 'required|in:draft,published,scheduled',
        ]);
        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        //// Handle image upload
        if ($request->hasFile('image')) {
            // $validated['image'] = $request->file('image')->store('posts', 'public');
            $image = $request->file('image');
            
            // Generate a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Move to public/images/rooms
            $image->move(public_path('storage/images/posts'), $filename);
            
            // Store the path in database
            $validated['image'] = 'images/posts/' . $filename;
            if($blog->image){
                File::delete(public_path('storage/'.$room->image));
            }
        }
        // Create post
        $blog->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }
    
    public function post_destroy(Blog $blog) {
        if($blog->image){
            File::delete(public_path('storage/'.$room->image));
        }
        $blog->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }

    public function messages_index() {
        $messages = Contact::all();
        return view('admin.contact-page', compact('messages'));
    }


}
