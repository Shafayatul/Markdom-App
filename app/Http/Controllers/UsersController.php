<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Hash;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->orWhere('password_confirmation', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }
        $roles = Role::pluck('name','name');
        return view('users.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $name               = $request->name;
        $email              = $request->email;
        $password           = $request->password;
        $confirm_password   = $request->password_confirmation;
        $status             = 0;
        
        if($password == $confirm_password){
            User::create([
                'name'      => $name,
                'email'     => $email,
                'password'  => Hash::make($password),
                'status'    => $status,
            ]);
            return redirect('users')->with('success', 'User added!');
        }else{
            return redirect('users')->with('error', 'Password and Confirmed password not matching!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $user           = User::findOrFail($id);
        $user->name     = $request->name;
        $user->status   = $request->status;
        $user->save();

        return redirect('users')->with('success', 'User updated!');
    }

    public function userAssigned(Request $request)
    {
        $id     = $request->user_id;
        $user   = User::where('id',$id)->first();
        $role   = $request->role;
        if($user){
            $user->syncRoles($role);
        }
        return redirect('users')->with('success','User Assigned');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('users')->with('success', 'User deleted!');
    }

    public function userActivated($id)
    {
        $user           = User::findOrFail($id);
        $user->status   = 1;
        $user->save();
        return redirect('users')->with('success', 'Status Updated!');
    }

    public function userInactivated($id)
    {
        $user           = User::findOrFail($id);
        $user->status   = 0;
        $user->save();
        return redirect('users')->with('success', 'Status Updated!');
    }

    public function passwordChangeView()
    {
        return view('users.password-change');
    }

    public function passwordChanged(Request $request)
    {
        $this->validate($request,[
            'old_password'      => ['required', 'string', 'min:8'],
            'new_password'      => ['required', 'string', 'min:8'],
            'confirm_password'  => ['required', 'string', 'min:8'],
        ]);

        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;
        
        if(Auth::check()){
            if($new_password == $confirm_password){
                $current_password = Auth::user()->password;
                if(Hash::check($old_password, $current_password))
                {
                    $id             = Auth::user()->id;
                    $user           = User::findOrFail($id);
                    $user->password = Hash::make($new_password);
                    $user->save(); 
                    return redirect()->back()->with('success', 'Passowrd Updated!');
                }
            }else{
                return redirect()->back()->with('error','New Password and Confirm password not matching!');
            }
        }else{
            return redirect('/login');
        }
    }
}
