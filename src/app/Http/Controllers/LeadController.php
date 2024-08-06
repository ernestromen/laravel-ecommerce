<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Events\testEvent;
use App\Models\Product;

class LeadController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";

        $leads = Lead::all();

        return view("leads", ["currentUser" => $currentUser, 'leads' => $leads]);
    }

    public function store(Request $request){

        $lead = new Lead();
        $lead->firstname = $request->firstname;
        $lead->lastname = $request->lastname;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->message = $request->message;
        $entity = new Product();
        event(new testEvent($entity));
        $lead->save();

        return redirect('/');
    }

    public function edit($id)
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $lead = Lead::find($id);
        return view("edit_lead", ["currentUser" => $currentUser, "lead" => $lead]);

    }
    public function update(Request $request, string $id)
    {
        $lead = Lead::find($id);
        $lead->firstname = $request->firstname;
        $lead->lastname = $request->lastname;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->message = $request->message;

        $lead->save();

        return redirect('/leads');

    }

    public function destroy($id)
    {
        Lead::destroy($id);
        return redirect('/leads');
    }
}
