<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TraitApi;
use DB;
use Validator;
use Carbon\Carbon;
use App\Models\Contact;

class ContactController extends Controller
{
    use TraitApi;

    /**
     * create contact
     */

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'email'             => 'required|email',
            'phone_number'      => 'required',
        ]);
        if($validator->fails()){
            return $this->responseApi('error','',$validator->errors());
        }else{
            $data               = $request->all();
            $contact            = Contact::create($data);
            $msg['name']        = $contact->name;
            return $this->responseApi('ok',$msg,'Register success');
        }
    }

    /**
     * contact list
     */
    public function list()
    {
        $contact = Contact::where('is_delete',0)->get();
        return $this->responseApi('ok',$contact,'Contact found');
    }

    /**
     * edit contact
     */
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'email'             => 'required|email',
            'phone_number'      => 'required',
        ]);
        if($validator->fails()){
            return $this->responseApi('error','',$validator->errors());
        }

        $data   = $request->all();

        Contact::where('id',$data['id'])->update([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone_number'  => $data['phone_number']
        ]);

        return $this->responseApi('ok','','Update data success');
    }

    /**
     * delete contact
     */
    public function delete(Request $request)
    {
        $data   = $request->all();
        Contact::where('id',$data['id'])->update([
            'is_delete'     => 1
        ]);
        return $this->responseApi('ok','','delete success');
    }
}
