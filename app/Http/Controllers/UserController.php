<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Session;
use App\User;

class UserController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function edit($email)
    {
        // check if email exist
        User::where('email', '=', $email)->firstOrFail();

        // check if his profile of user loggedin
        if (Auth::user()->email == $email)
        {
            // return with view with view edit
            return view('frontend.users.edit');
        }
        else
        {
            // redirect to home
            return redirect('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        // check if email exist
        $user = User::where('email', '=', $email)->firstOrFail();

        // check if his profile of user loggedin
        if (Auth::user()->email == $email)
        {
            // validate fields
            $this->validate($request, [
                'name'  => 'required|min:3',
                'email' => 'email|required|unique:users,email,'.Auth::User()->id,
            ]);

            // stock all fields in $input
            $input = $request->all();

            // fill all input to save for user
            $user->fill($input)->save();

            //redirect with success message
            return redirect()->back()->with('status', 'Profile updated!');

        }
        else
        {
            //redirect with error message
            return redirect('home')->with('status', 'Not authorize!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        // check if email exist
        $user = User::where('email', '=', $email)->firstOrFail();

        // check if his profile of user loggedin
        if (Auth::user()->email == $email)
        {

            // delete user
            $user->delete();

            // logout user
            Auth::logout();

            // redirect to home
            return redirect('/');

        }
        else
        {
            //redirect with error message
            return redirect('home')->with('status', 'Not authorize!');
        }
    }
}
