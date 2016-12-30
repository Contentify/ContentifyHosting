<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Validator;
use App\Server;
use App\Datacenter;
use App\Provider;
use App\Country;
use App\User;

class ServerBackendController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    // Retrieve all datacenters
    $servers = Server::all();

    // return view index with all datacenters
    return view('backend.servers.index')->with('servers', $servers);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

    // retrieve all providers
    $providers = Provider::pluck('name', 'id');

    // retrieve all datacenters
    $datacenters = Datacenter::pluck('name', 'id');

    // retrieve all users
    $users = User::pluck('name', 'id');

    // return form servers with all countries
    return view('backend.servers.form')->with(array('datacenters' => $datacenters, 'providers' => $providers, 'users' => $users));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    // validate fields
    $validator = Validator::make($request->all(), [
      'name'          => 'required|min:3',
      'provider_id'   => 'required',
      'datacenter_id' => 'required',
      'user_id'       => 'required',
    ]);

    // check if validation success
    if ($validator->fails()) {

      // Flash Message error
      notify('Server can\'t be created!', 'error');

      // back to form with inputs
      return back()->withErrors($validator)->withInput();
    }

    // store all values in $input
    $input = $request->all();

    // create server with values
    Server::create($input);

    // Flash Message success
    notify('Server created!', 'success');

    // redirect with success flash message
    return redirect()->route('server.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    // retrieve server
    $server = server::findOrFail($id);

    // return server
    return view('backend.servers.show')->with('server', $server);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

    // retrieve server
    $server = server::findOrFail($id);

    // return form with server
    return view('backend.servers.form')->with('server', $server);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {

    // retrieve server
    $server = server::findOrFail($id);

    // validate fields
    $validator = Validator::make($request->all(), [
      'name'          => 'required|min:3',
      'provider_id'   => 'required',
      'datacenter_id' => 'required',
      'user_id'       => 'required',
    ]);

    // check if validation success
    if ($validator->fails()) {

      // Flash Message error
      notify('Server can\'t be updated!', 'error');

      // back to form with inputs
      return back()->withErrors($validator)->withInput();
    }

    // stock all fields in $input
    $input = $request->all();

    // fill all input to save for server
    $server->fill($input)->save();

    // Flash Message success
    notify('Server updated!', 'success');

    //redirect with success message
    return redirect()->route('server.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

    // retrieve server
    $server = server::findOrFail($id);

    // delete server
    $server->delete();

    // Flash Message success
    notify('Server deleted!', 'info');

    // redirect to home
    return redirect()->route('server.index');

  }

  /**
   * Get datacenter from providerId
   *
   * @param  int  $providerId
   * @return Response
   */
  public function getDatacenter(Request $request, $providerId)
  { 

    //check if request is Ajax
    if($request->ajax()){

      // retrieve server
      $datacenters = Datacenter::where('provider_id', '=', $providerId)->get();
      // return datacenters from provider
      return $datacenters;

    }
    abort('404');
  }
  
}

?>