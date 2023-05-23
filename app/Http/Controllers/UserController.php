<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():view
    {
        $users = DB::table('users')->select('users.*','profile.role')->leftJoin('profile', 'users.id', '=', 'profile.user_id')->get();
        return view ('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        if($users = DB::table('users')->where('email', $email)->first()){
            return Redirect::back()->with('error', 'Email Sudah digunakan!');
        }
        // dd($password);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];
        $user = DB::table('users')->insertGetId($data);
        $data = [
            'role' => $role,
            'user_id' => $user,
        ];
        $user = DB::table('profile')->insert($data);
        return redirect('users')->with('success', 'User Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $profile = Profile::find($id);
        return view('users.layout')->with('users', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        $users = DB::table('users')->select('users.*','profile.role')->leftJoin('profile', 'users.id', '=', 'profile.user_id')->where('users.id', $id)->first();
        // dd($profile);
        return view('users.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $user_id = Crypt::decrypt($request->user_id);
        $data = [];
        if(empty($password)){
            $data = [
                'name' => $name,
                'email' => $email,
            ];
        }else{
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ];
        }
        DB::table('users')->where(['id' => $user_id])->update($data);
        // dd($data);
        $data = [
            'role' => $role
        ];
        DB::table('profile')->where(['user_id' => $user_id])->update($data);
        return redirect('users')->with('success', 'User Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        $user = DB::table('users')->where('id',$id)->delete();
        $user = DB::table('profile')->where('user_id',$id)->delete();
        return redirect('users')->with('success', 'User Deleted!');


        // Profile::destroy($id);
        // return redirect('users')->with('success', 'User deleted!');
    }
}
