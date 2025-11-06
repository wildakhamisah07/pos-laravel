<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Profile";
        $user = Auth::user();
        $userDetail = Auth::user()->userDetail;
        return view('profile.index', compact('title', 'user', 'userDetail'));
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = Auth::user();
        //jika password lama berbeda, ex = 12345
        if (!Hash::check($request->old_password, $user->password)) {
            // return $request;
            alert()->warning('Failed!!! Bro', 'The Old Password is Wrong !!! ');
            return back();
        }
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        alert()->success('Success', 'The Change Password Success bro !!!');
        return back();
    }

    public function changeProfile(Request $request)
    {

        $user = Auth::user();
        $photoPath = "";

        //photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            if ($user->userDetail && $user->userDetail->photo) {
                File::delete(public_path('storage/' . $user->userDetail->photo));
            }
            $photoPath = $photo->store('profile', 'public'); //storage/app/publice
        }
        //upsert = update dan insert dr laravel. jika ada datany ngk ada maka d insert. tp jika sudah ada maka akan di update
        try {
            UserDetail::upsert(
                [
                    //ini utk insert
                    [
                        'user_id' => $user->id,
                        'about' => $request->about,
                        'company' => $request->company,
                        'job' => $request->job,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'photo' => $photoPath ?? ($user->userDetail->photo ?? '')

                    ],
                ],
                //pengecekan data unique nya
                ['user_id'], //ini si unique
                [
                    'phone',
                    'about',
                    'company',
                    'job',
                    'address',
                    'photo'
                ]
            );
            alert()->success('Success', 'Edit Profile Success CUYYY....');
            return redirect()->to('profile');
        } catch (\Throwable $th) {
            alert()->error('error', $th->getMessage());
            return redirect()->to('profile');
        }
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
