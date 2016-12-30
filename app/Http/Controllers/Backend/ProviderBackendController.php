<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Validator;
use App\Provider;

class ProviderBackendController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    // Retrieve all providers
    $providers = Provider::all();

    // return view index with all providers
    return view('backend.providers.index')->with('providers', $providers);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

    // return form providers
    return view('backend.providers.form');
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
      'name'      => 'required|min:3|unique:providers,name,'.$provider->id,
    ]);

    // check if validation success
    if ($validator->fails()) {

      // Flash Message error
      notify('Provider can\'t be created!', 'error');

      // back to form with inputs
      return back()->withErrors($validator)->withInput();
    }

    // store all values in $input
    $input = $request->all();

    // create provider with values
    Provider::create($input);

    // Flash Message success
    notify('Provider created!', 'success');

    // redirect with success flash message
    return redirect()->route('provider.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    // retrieve provider
    $provider = Provider::findOrFail($id);

    // return provider
    return view('backend.providers.show')->with('provider', $provider);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

    // retrieve provider
    $provider = Provider::findOrFail($id);

    // return form with provider
    return view('backend.providers.form')->with('provider', $provider);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {

    // retrieve provider
    $provider = Provider::findOrFail($id);

    // validate fields
    $validator = Validator::make($request->all(), [
      'name'      => 'required|min:3|unique:providers,name,'.$provider->id,
    ]);

    // check if validation success
    if ($validator->fails()) {

      // Flash Message error
      notify('Provider can\'t be updated!', 'error');

      // back to form with inputs
      return back()->withErrors($validator)->withInput();
    }

    // stock all fields in $input
    $input = $request->all();

    // fill all input to save for provider
    $provider->fill($input)->save();

    // Flash Message success
    notify('Provider updated!', 'success');

    //redirect with success message
    return redirect()->route('provider.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

    // retrieve provider
    $provider = Provider::findOrFail($id);

    // delete provider
    $provider->delete();

    // Flash Message success
    notify('Provider deleted!', 'info');

    // redirect to home
    return redirect()->route('provider.index');

  }
  
}

?>