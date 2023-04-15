<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getList(Request $request) {
        $listContact = Contact::all();

        $data['status'] = 200;
        $data['contacts'] = $listContact;
        return response()->json($data);
    }

    public function addContact(Request $request) {
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $phone = $request['phone'];
        $address = $request['address'];

        $newcon = new Contact;
        $newcon->first_name = $firstname;
        $newcon->last_name = $lastname;
        $newcon->email = $email;
        $newcon->phone = $phone;
        $newcon->address = $address;
        $newcon->save();

        $data['status'] = 200;
        $data['message'] = 'Information has been saved.';
        return response()->json($data);

    }
}
