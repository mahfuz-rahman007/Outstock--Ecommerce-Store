<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Order;
use App\Model\Emailsetting;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;

class ProductOrderController extends Controller
{

    public function all()
    {
        $orders = Order::all();

        return view('admin.product.order.index', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::where('order_status', '0')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', compact('orders'));
    }

    public function processing()
    {

        $orders = Order::where('order_status', '1')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', compact('orders'));
    }

    public function completed()
    {

        $orders = Order::where('order_status', '2')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', compact('orders'));
    }

    public function rejected()
    {

        $orders = Order::where('order_status', '3')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index',  compact('orders'));
    }

    public function status(Request $request)
    {

        $order = Order::find($request->order_id);
        $order->order_status = $request->order_status;
        $order->save();


        if ($request->order_status == 0) {
            $ostatus = 'Pending';
        } elseif ($request->order_status == 1) {
            $ostatus = 'Processing';
        } elseif ($request->order_status == 2) {
            $ostatus = 'Completed';
        } elseif ($request->order_status == 3) {
            $ostatus = 'Rejected';
        }

        $user = User::findOrFail($order->user_id);

        $em = Emailsetting::first();
        $sub = 'Order Status Update';
        // Send Mail to Buyer
        $mail = new PHPMailer(true);


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

                // Content
                $mail->isHTML(true);
                $mail->Subject = $sub;
                $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your product order status is ' . $ostatus . '.<br/>Thank you.';
                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        } else {
            try {

                //Recipients
                $mail->setFrom($em->from_mail, $em->from_name);
                $mail->addAddress($user->email, $user->name);


                // Content
                $mail->isHTML(true);
                $mail->Subject = $sub;
                $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your product order status is ' . $ostatus . '.<br/>Thank you.';

                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        }

        $notification = array(
            'messege' => 'Order status changed successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function payment_status(Request $request)
    {

        $order = Order::find($request->order_id);
        $order->payment_status = $request->payment_status;
        $order->save();


        if($request->payment_status == 0){
            $ostatus = 'Pending';
        }
        elseif($request->payment_status == 1){
            $ostatus = 'Complete';
        }

        $user = User::findOrFail($order->user_id);
        $em = Emailsetting::first();
        $sub = 'Order Status Update';
        // Send Mail to Buyer
        $mail = new PHPMailer(true);


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

                // Content
                $mail->isHTML(true);
                $mail->Subject = $sub;
                $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your product payment status is ' . $ostatus . '.<br/>Thank you.';
                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        } else {
            try {

                //Recipients
                $mail->setFrom($em->from_mail, $em->from_name);
                $mail->addAddress($user->email, $user->name);


                // Content
                $mail->isHTML(true);
                $mail->Subject = $sub;
                $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your product payment status is ' . $ostatus . '.<br/>Thank you.';

                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        }

        $notification = array(
            'messege' => 'Order status changed successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function details($id)
    {

        $order = Order::findOrFail($id);

        return view('admin.product.order.details',compact('order'));
    }



    public function orderDelete(Request $request)
    {

        $order = Order::findOrFail($request->order_id);
        @unlink('assets/front/invoices/product/'.$order->invoice_number);

        $order->delete();

        $notification = array(
            'messege' => 'product order deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }
}
