<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\PaymentGateway;
use App\Http\Controllers\Controller;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $data = PaymentGateway::get();
        return view('admin.payment_gateway.index',compact('data'));
    }


    public function edit($id)
    {
        $data = PaymentGateway::findOrFail($id);
        return view('admin.payment_gateway.edit',compact('data'));

    }


    public function update(Request $request , $id)
    {
        $data =  PaymentGateway::findOrFail($id);
        $prev = '';


        if($data->type == "automatic"){


           $request->validate([
            'image' => 'mimes:jpeg,jpg,png',
            'title' => 'required|unique:payment_gateways,title,'.$id

           ]);

            $input = $request->all();


            if($request->hasFile('image')){
                @unlink('assets/front/img/'. $data->image);

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $image = time().rand().'.'.$extension;
                $file->move('assets/front/img/', $image);

                $input['image'] = $image;

            }




            $info_data = $input['pkey'];

            if($data->keyword == 'mollie'){
                $paydata = $data->convertAutoData();
                $prev = $paydata['key'];
            }

            if (array_key_exists("sandbox_check",$info_data)){
                $info_data['sandbox_check'] = 1;
            }else{
                if (strpos($data->information, 'sandbox_check') !== false) {
                    $info_data['sandbox_check'] = 0;
                    $text =  $info_data['text'];
                    unset($info_data['text']);
                    $info_data['text'] = $text;
                }
            }
            $input['information'] = json_encode($info_data);


            $data->update($input);

        }
        else{



            $request->validate([
                'image' => 'mimes:jpeg,jpg,png',
                'title' => 'required|unique:payment_gateways,title,'.$id
            ]);


            $input = $request->all();

            if($request->hasFile('image')){
                @unlink('assets/front/img/'. $data->image);

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $image = time().rand().'.'.$extension;
                $file->move('assets/front/img/', $image);

                $input['image'] = $image;

            }


            $data->update($input);
        }


        $notification = array(
            'messege' => 'Payment Gateway Updated Successfully.',
            'alert' => 'success'
        );


        return redirect(route('admin.payment'))->with('notification', $notification);

    }
}
