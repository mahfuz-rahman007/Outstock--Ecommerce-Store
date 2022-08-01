<?php

namespace App\Http\Controllers\Payment\Product;

use App\Model\Order;
use App\Model\Product;
use App\Helpers\Helper;
use App\Model\Shipping;
use App\Model\Emailsetting;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CashOnDeliveryController extends Controller
{


    public function submit(Request $request){

        if(!Auth::user()){
            return redirect(route('user.login'));
        }

        $user_id = Auth::user()->id;

        if(!Session::has('cart')){
            return view('errors.404');
        }

        if(! array_key_exists($user_id , Session::get('cart'))){
            return view('errors.404');
        }

        $cart = Session::get('cart');

        $cart_total = 0;
        $qty = 0;
        foreach ($cart[$user_id] as $id => $item) {

            $product = Product::findOrFail($id);

            if ($product->stock < $item['qty']) {
                $notification = array(
                    'messege' =>  $product->title . ' stock not available',
                    'alert' => 'error'
                );
                return redirect()->back()->with('notification', $notification);
            }
            $cart_total += (float)$item['price'] * (int)$item['qty'];
            $qty += $item['qty'];
        };

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_number' => 'required',
            'billing_address' => 'required',
            'billing_country' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_zip' => 'required',

        ]);

        $input = $request->all();

        $shipping = Shipping::findOrFail($request->shipping_charge);

        $input['shipping_charge'] = json_encode($shipping, true);

        $total = Helper::storePrice($cart_total + $shipping->cost);

        $success_url = action('Payment\Product\PaypalController@payreturn');
        $cancel_url = route('product.paypal.cancle');



        if($total){
            $order = new Order();
            $user = Auth::user();

            $order['txn_id'] = '';
            $order['cart'] = json_encode($cart[$user_id], true);
            $order['user_info'] = json_encode($user, true);
            $order['user_id'] = $user->id;
            $order['method'] = 'Cash On Delivery';
            $order['order_number'] = Str::random(8);
            $order['payment_status'] = 0;
            $order['order_status'] = 0;
            $order['shipping_charge_info'] = $input['shipping_charge'];
            $order['total'] = $total;
            $order['qty'] = $qty;

            $order['currency_name'] = $input['currency_code'];
            $order['currency_sign'] =  $input['currency_sign'];
            $order['currency_value'] =  $input['currency_value'];

            $order['billing_name'] =  $input['billing_name'];
            $order['billing_email'] =  $input['billing_email'];
            $order['billing_number'] =  $input['billing_number'];
            $order['billing_address'] =  $input['billing_address'];
            $order['billing_country'] =  $input['billing_country'];
            $order['billing_city'] =  $input['billing_city'];
            $order['billing_state'] =  $input['billing_state'];
            $order['billing_zip'] =  $input['billing_zip'];
            $order['created_at'] =  Carbon::now();



            $order->save();
            $order_id = $order->id;


            foreach ($cart[$user_id] as $id => $item) {
                $product = Product::findOrFail($id);

                $stock = $product->stock - $item['qty'];
                Product::where('id', $id)->update([
                    'stock' => $stock
                ]);
            };


            $fileName = Str::random(4) . time() . '.pdf';
            $path = 'assets/front/invoices/product/' . $fileName;
            $data['order']  = $order;
            $pdf = PDF::loadView('pdf.product', $data)->save($path);

            Order::where('id', $order_id)->update([
                'invoice_number' => $fileName
            ]);

            // Send Mail to Buyer
            $mail = new PHPMailer(true);
            $user = Auth::user();

            $em = Emailsetting::first();

            if ($em->is_smtp == 1) {
                try {

                    $mail->isSMTP();
                    $mail->Host       = $em->smtp_host;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $em->smtp_user;
                    $mail->Password   = $em->smtp_pass;
                    $mail->SMTPSecure = $em->email_encryption;
                    $mail->Port       = $em->smtp_port;

                    //Recipients
                    $mail->setFrom($em->from_email, $em->from_name);
                    $mail->addAddress($user->email, $user->name);

                    // Attachments
                    $mail->addAttachment('assets/front/invoices/product/' . $fileName);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = "Order placed for Product";
                    $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your order has been placed successfully. We have attached an invoice in this mail.<br/>Thank you.';

                    $mail->send();
                } catch (Exception $e) {
                    // die($e->getMessage());
                }
            } else {
                try {

                    //Recipients
                    $mail->setFrom($em->from_mail, $em->from_name);
                    $mail->addAddress($user->email, $user->name);

                    // Attachments
                    $mail->addAttachment('assets/front/invoices/product/' . $fileName);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = "Order placed for Product";
                    $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your order has been placed successfully. We have attached an invoice in this mail.<br/>Thank you.';

                    $mail->send();
                } catch (Exception $e) {
                    // die($e->getMessage());
                }
            }


            unset($cart[$user_id]);

            Session::put('cart', $cart);

            return view('front.success.product');
        }
    }


}
