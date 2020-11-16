<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::where('role_id', '!=' ,'3')->get();
        return view('admin.doctor.index', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'patient')->orderBy('id', 'desc')->get();
        return view('admin.doctor.create', ['roles' => $roles]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => ['required', 'numeric', 'min:8'],
            'role_id' => 'required',
            'image' => ['image', 'max:2048']
        ]);

        $image = $this->imgHandle($request);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), //TODO: gen random temp password to change on email request
            'gender' => $request->gender,
            'image' => $image,
            'education' => $request->education,
            'address' => $request->address,
            'department' => $request->department,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id
        ]);
        
        return redirect()->back()->with('message', 'Doctor registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = User::find($id);
        return view('admin.doctor.delete', ['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = User::find($id);
        $roles = Role::where('name', '!=', 'patient')->get();
        
        return view('admin.doctor.edit', ['doctor' => $doctor, 'roles' => $roles]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => ['required', 'numeric', 'min:8'],
            'role_id' => 'required',
            'image' => ['image', 'max:2048']
        ]);
        
        $doctor = User::find($id);
        $image = $doctor->image;
        
        if($request->hasFile('image'))
        {
            if(file_exists(public_path('images/' . $image)) && $image != '')
                unlink(public_path('images/' . $image));
            $image = $this->imgHandle($request);
        }
        
        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'image' => $image,
            'education' => $request->education,
            'address' => $request->address,
            'department' => $request->department,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id
        ]);
        
        return redirect()->route('doctor.index')->with('message', 'Doctor updated successfully!');
    }

    private function imgHandle(Request $request)
    {
        $img = $request->file('image');
        
        if($img == null) 
            return;

        $image = stripslashes(Hash::make($img->getClientOriginalName())) . '.' .$img->getClientOriginalExtension();
        $image = str_replace('/','',$image);
        $img->move((public_path('images')), $image);
        
        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = User::find($id);

        $image = $doctor->image;
        if(file_exists(public_path('images/' . $image)) && $image != '')
            unlink(public_path('images/' . $image));
            
        $doctor->delete();
        return redirect()->route('doctor.index')->with('message', 'Doctor deleted successfully!');
    }
}
