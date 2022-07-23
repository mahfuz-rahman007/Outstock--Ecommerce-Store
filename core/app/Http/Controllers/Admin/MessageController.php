<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use App\Model\Emailsetting;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function message()
    {
        $messages = Message::all();
        return view('admin.message.index', compact('messages'));
    }

    public function send($id){
        $message = Message::findOrFail($id);
        $name = $message->name;
        $email = $message->email;
        $subject = $message->subject;
        $body = $message->message;

        $em = Emailsetting::first();
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
                $mail->setFrom($email, $name);
                $mail->addAddress($em->from_email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = "Name: ".$name."<br> Email: ".$email."<br> Message: ".$body;

                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        } else {
            try {
                //Recipients
                $mail->setFrom($email, $name);
                $mail->addAddress($em->from_email);


                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = "Name: ".$name."<br> Email: ".$email."<br> Message: ".$body;

                $mail->send();
            } catch (Exception $e) {
                // die($e->getMessage());
            }
        }

        $notification = array(
            'messege' => 'Message Sent successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);


    }

    public function delete(Request $request , $id)
    {
        $message = Message::findOrFail($id);

        $message->delete();

        $notification = array(
            'messege' => 'Message Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

}
