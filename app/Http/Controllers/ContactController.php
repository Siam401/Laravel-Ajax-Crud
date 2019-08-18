<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Contact;
class ContactController extends Controller
{

    public function index()
    {

        return view('all_contact');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = [
        'name' => $request['name'],
        'email' => $request['email'],
        'phone' => $request['phone'],
        'religion' => $request['religion']
       ];
        return Contact::create($data);
    }


    public function show($id)
    {
         $contact=Contact::find($id);
        return $contact;
    }


    public function edit($id)
    {
        $contact=Contact::find($id);
       return $contact;
    }


    public function update(Request $request, $id)
    {
        $contact=Contact::find($id);
       $contact->name=$request['name'];
       $contact->phone=$request['phone'];
       $contact->email=$request['email'];
       $contact->religion=$request['religion'];
       $contact->update();
       return $contact;
    }


    public function destroy($id)
    {
         Contact::destroy($id);
    }

    public function allcontact()
    {
        $contact=Contact::all();
        return Datatables::of($contact)
          ->addColumn('action', function($contact){
             return '<a onclick="showData('.$contact->id.')" class="btn btn-sm btn-success">Show</a>'.' '. 
                    '<a onclick="editForm('.$contact->id.')" class="btn btn-sm btn-info">Edit</a>'.' '. 
                    '<a onclick="deleteData('.$contact->id.')" class="btn btn-sm btn-danger">Delete</a>';

          })->make(true);
    }
}
