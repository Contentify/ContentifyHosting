<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Plan;
use App\Provider;

use Validator;

use Braintree\Plan as BraintreePlan;

class PlanBackendController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        // Retrieve all plans
        $plans = Plan::all();

        // return view index with all plans
        return view('backend.plans.index')->with('plans', $plans);
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

        // retrieve all plan from Braintree
        $braintreePlans = BraintreePlan::all();

        // return form plan with provider and plan from braintree
        return view('backend.plans.form')->with(array('braintreePlans' => $braintreePlans, 'providers' => $providers));
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
          'name'            => 'required|min:3|unique:plans',
          'provider_id'     => 'required',
          'braintree_id'    => 'required|unique:plans',
          'amount'          => 'required',
          'interval'        => 'required',
        ]);

        // check if validation success
        if ($validator->fails()) {

            // Flash Message error
            notify('Plan can\'t be created!', 'error');

            // back to form with inputs
            return back()->withErrors($validator)->withInput();
        }

        // store all values in $input
        $input = $request->all();

        // create plan with values
        Plan::create($input);

        // Flash Message success
        notify('Plan created!', 'success');

        // redirect with success flash message
        return redirect()->route('plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        // retrieve plan
        $plan = Plan::findOrFail($id);

        // return plan
        return view('backend.plans.show')->with('plan', $plan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        // retrieve plan
        $plan = Plan::findOrFail($id);

        // retrieve all plan from Braintree
        $braintreePlans = BraintreePlan::all();

        // return form with plan
        return view('backend.plans.form')->with(array('plan' => $plan, 'braintreePlans' => $braintreePlans));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        // retrieve plan
        $plan = Plan::findOrFail($id);

        // validate fields
        $validator = Validator::make($request->all(), [
          'name'            => 'required|min:3|unique:plans,name,'.$id,
          'provider_id'     => 'required',
          'braintree_id'    => 'required|unique:plans,braintree_id,'.$id,
          'amount'          => 'required',
          'interval'        => 'required',
        ]);

        // check if validation success
        if ($validator->fails()) {

            // Flash Message error
            notify('Plan can\'t be updated!', 'error');

            // back to form with inputs
            return back()->withErrors($validator)->withInput();
        }

        // stock published field
        $request->request->add(['published' => $request->input('published', '0')]);

        // stock all fields in $input
        $input = $request->all();

        // fill all input to save for plan
        $plan->fill($input)->save();

        // Flash Message success
        notify('Plan updated!', 'success');

        //redirect with success message
        return redirect()->route('plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        // retrieve plan
        $plan = Plan::findOrFail($id);

        // delete plan
        $plan->delete();

        // Flash Message success
        notify('Plan deleted!', 'info');

        // redirect to home
        return redirect()->route('plan.index');
    }

}
