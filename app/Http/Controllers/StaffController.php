<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = User::where('role_id', '!=', '3')
                        ->get();
        return view('admin.staff.index', ['staff' => $staff]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'patient')
                        ->orderBy('id', 'desc')
                        ->get();
        
        return view('admin.staff.create', ['roles' => $roles]);
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
            'gender' => Rule::requiredIf($request->role_id == '2'),
            'education' => Rule::requiredIf($request->role_id == '2'),
            'address' => 'required',
            'department' => Rule::requiredIf($request->role_id == '2'),
            'phone_number' => ['required', 'numeric', 'min:8'],
            'role_id' => 'required',
            'image' => ['image', 'max:2048']
        ]);

        $image = $this->imgHandle($request);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), //FIXME: gen random temp password to change on email request
            'gender' => $request->gender,
            'image' => $image,
            'education' => $request->education,
            'address' => $request->address,
            'department' => $request->department,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id
        ]);
        
        return redirect()->back()->with('message', 'Member registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = User::find($id);
        return view('admin.staff.delete', ['staff' => $staff]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = User::find($id);
        $roles = Role::where('name', '!=', 'patient')
                        ->get();
        
        return view('admin.staff.edit', ['staff' => $staff, 'roles' => $roles]);
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'gender' => Rule::requiredIf($request->role_id == '2'),
            'education' => Rule::requiredIf($request->role_id == '2'),
            'address' => 'required',
            'department' => Rule::requiredIf($request->role_id == '2'),
            'phone_number' => ['required', 'numeric', 'min:8'],
            'role_id' => 'required',
            'image' => ['image', 'max:2048']
        ]);
        
        $staff = User::find($id);
        $image = $staff->image;
        
        if($request->hasFile('image'))
        {
            if(file_exists(public_path('images/' . $image)) && $image != '')
                unlink(public_path('images/' . $image));
            $image = $this->imgHandle($request);
        }
        
        $staff->update([
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
        
        return redirect()->route('staff.index')->with('message', 'Member updated successfully!');
    }

    private function imgHandle(Request $request)
    {
        $img = $request->file('image');
        
        if($img == null) 
            return;

        $image = Hash::make($img->getClientOriginalName()) . '.' .$img->getClientOriginalExtension();
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
        if(Auth::user()->id == $id)
            abort(401);
            
        $staff = User::find($id);
        $image = $staff->image;
        
        if(file_exists(public_path('images/' . $image)) && $image != '')
            unlink(public_path('images/' . $image));   
        $staff->delete();

        return redirect()->route('staff.index')->with('message', 'Member deleted successfully!');
    }
}
