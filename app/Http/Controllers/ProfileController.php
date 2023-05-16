<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Profile;
use Illuminate\View\View;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():view
    {
        $profiles = Profile::all();
        return view ('profiles.index')->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->all();
        // dd($input);
        Profile::create($input);
        return redirect('profiles')->with('flash_message', 'User Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $profile = Profile::find($id);
        return view('profiles.layout')->with('profiles', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        $profile = Profile::find($id);
        // dd($profile);
        return view('profiles.edit')->with('profiles', $profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        $profile = Profile::find($id);
        $input = $request->all();
        $profile->update($input);
        return redirect('profiles')->with('flash_message', 'User Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Profile::destroy($id);
        return redirect('profiles')->with('flash_message', 'User deleted!');
    }
}
