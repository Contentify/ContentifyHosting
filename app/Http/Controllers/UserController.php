<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Session, Validator;
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

        // check if his profile of user loggedin
        if (Auth::user()->email == $email)
        {
            // check if email exist
            User::where('email', '=', $email)->firstOrFail();

            // return with view with view edit
            return view('frontend.users.edit');
        }
        else
        {
            // Flash Message success
            notify('Unauthorized!', 'error');
            
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
        // check if his profile of user loggedin
        if (Auth::user()->email == $email)
        {
            // check if email exist
            $user = User::where('email', '=', $email)->firstOrFail();

            // validate fields
            $validator = Validator::make($request->all(), [
                'name'   => 'required|min:3',
                'email'  => 'email|required|unique:users,email,'.Auth::User()->id
            ]);

            // check if validation success
            if ($validator->fails()) {

              // Flash Message error
              notify('User can\'t be updated!', 'error');

              // back to form with inputs
              return back()->withErrors($validator)->withInput();
            }

            // stock all fields in $input
            $input = $request->all();

            // fill all input to save for user
            $user->fill($input)->save();

            // Flash Message success
            notify('User updated!', 'success');

            //redirect with success message
            return redirect()->back();

        }
        else
        {
            // Flash Message success
            notify('Unauthorized!', 'error');

            //redirect with error message
            return redirect('home');
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
        // check if his profile of user loggedin
        if (Auth::user()->email == $email)
        {
            // check if email exist
            $user = User::where('email', '=', $email)->firstOrFail();

            // delete user
            $user->delete();

            // logout user
            Auth::logout();

            // Flash Message success
            notify('Account deleted!', 'info');

            // redirect to home
            return redirect('/');

        }
        else
        {
            // Flash Message success
            notify('Unauthorized!', 'error');

            //redirect with error message
            return redirect('home');
        }
    }
}
