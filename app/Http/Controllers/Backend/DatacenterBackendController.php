<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View;
use App\Datacenter;
use App\Provider;
use App\Country;

class DatacenterBackendController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    // Retrieve all datacenters
    $datacenters = Datacenter::all();

    // return view index with all datacenters
    return view('backend.datacenters.index')->with('datacenters', $datacenters);
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

    // retrieve all countries
    $countries = Country::pluck('name', 'id');

    // return form datacenters with all countries
    return view('backend.datacenters.form')->with(array('countries' => $countries, 'providers' => $providers));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    // validate fields
    $this->validate($request, [
      'name'        => 'required|min:3',
      'provider_id' => 'required',
      'country_id'  => 'required',
    ]);

    // store all values in $input
    $input = $request->all();

    // create datacenter with values
    Datacenter::create($input);

    // redirect with success flash message
    return redirect()->route('datacenter.index')->with('status', 'datacenter created!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    // retrieve datacenter
    $datacenter = Datacenter::findOrFail($id);

    // return datacenter
    return view('backend.datacenters.show')->with('datacenter', $datacenter);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

    // retrieve datacenter
    $datacenter = Datacenter::findOrFail($id);

    // return form with datacenter
    return view('backend.datacenters.form')->with('datacenter', $datacenter);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {

    // retrieve datacenter
    $datacenter = Datacenter::findOrFail($id);

    // validate fields
    $this->validate($request, [
      'name'        => 'required|min:3',
      'provider_id' => 'required',
      'country_id'  => 'required',
    ]);

    // stock all fields in $input
    $input = $request->all();

    // fill all input to save for datacenter
    $datacenter->fill($input)->save();

    //redirect with success message
    return redirect()->route('datacenter.index')->with('status', 'datacenter updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

    // retrieve datacenter
    $datacenter = Datacenter::findOrFail($id);

    // delete datacenter
    $datacenter->delete();

    // redirect to home
    return redirect()->route('datacenter.index');

  }
  
}

?>