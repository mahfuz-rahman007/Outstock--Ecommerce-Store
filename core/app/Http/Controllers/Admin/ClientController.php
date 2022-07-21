<?php

namespace App\Http\Controllers\Admin;

use App\Model\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function client()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function add()
    {
        return view('admin.client.add');
    }

    public function store(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $request->validate([
            "image"  => "required|mimes:jpg,jpeg,png,webp",
            "link"  => "regex:" . $regex,
            "status" => 'required|integer|between:0,1'
        ]);

        $client = new Client();
        if($request->hasFile('image')){
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $image = time().rand().'.'.$extension;
          $file->move('assets/front/img/',$image);

          $client->image = $image;
        }

        $client->link = $request->link;
        $client->status = $request->status;

        $client->save();


        $notification = array(
            'messege' => 'Client Added Successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.client'))->with('notification', $notification);
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request , $id)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $request->validate([
            "image"  => "mimes:jpg,jpeg,png",
            "link"  => "regex:" . $regex,
            "status" => 'required|integer|between:0,1'

        ]);


        $client = Client::findOrFail($id);

        if($request->hasFile('image')){
            @unlink('assets/front/img'.$client->image);

          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $image = time().rand().'.'.$extension;
          $file->move('assets/front/img/',$image);

          $client->image = $image;
        }
        $client->link = $request->link;
        $client->status = $request->status;

        $client->save();


        $notification = array(
            'messege' => 'Client Updated Successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.client'))->with('notification', $notification);
    }

    public function delete($id)
    {
        $client = Client::findOrFail($id);
        @unlink('assets/front/img/'.$client->image);
        $client->delete();

        $notification = array(
            'messege' => 'Client Deleted Successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.client'))->with('notification', $notification);
    }
}
