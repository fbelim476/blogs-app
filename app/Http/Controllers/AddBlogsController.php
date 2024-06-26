<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AddBlogs;
use DB;

class AddBlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addblogs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'blogsimage' => 'required', // Assuming this is a file upload, you might want 'image' => 'required|image'
        'tag' => 'required',
        'link' => 'required', // Assuming the link should be a valid URL
        'name' => 'required'
    ]);

    // Assuming 'image' is a file, you might want to handle file upload like this:
    // $imagePath = $request->file('image')->store('blogs', 'public');

    $data = [
        'title' => $request->title,
        'descriptions' => $request->description, // Fixed the key to 'description'
        'image' => $request->blogsimage, // Assuming you're storing the image path
        'tag' => $request->tag, // Fixed the key to 'tag'
        'link' => $request->link,
        'name' => $request->name
    ];

    AddBlogs::create($data);

    return redirect('/addblogs')->with('success', 'Thanks for adding blogs');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data=AddBlogs::all();
        return view('/manageblogs',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editblogs=AddBlogs::where('id',$id)->first();
        return view('/editblogs',['editblogs'=>$editblogs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'blogsimage' => 'required', // Assuming this is a file upload, you might want 'image' => 'required|image'
            'tag' => 'required',
            'link' => 'required', 
            'name' => 'required'
        ]);
        $data = [
            'title' => $request->title,
            'descriptions' => $request->description, 
            'image' => $request->blogsimage, 
            'tag' => $request->tag,
            'link' => $request->link,
            'name' => $request->name
        ];
        AddBlogs::where('id',$id)->update($data);
        return redirect('manageblogs')->with('success','Thanks for Update blogs');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AddBlogs::where('id',$id)->delete();
        return redirect('/manageblogs')->with('del','Your blogs are deleted successfully');

    }
}
