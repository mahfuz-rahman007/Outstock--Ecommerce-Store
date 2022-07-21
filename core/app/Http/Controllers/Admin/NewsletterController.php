<?php

namespace App\Http\Controllers\Admin;


use App\Model\Newsletter;
use App\Model\Emailsetting;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{

    public function newsletter(Request $request){

        $newsletters = Newsletter::orderBy('id', 'DESC')->get();

        return view('admin.newsletter.index', compact('newsletters'));
    }

    // Add newsletter Category
    public function add(){
        return view('admin.newsletter.add');
    }

    // Store newsletter Category
    public function store(Request $request){


        $request->validate([
            'newsletter' => [
                'required',
                'unique:newsletters,email',
                'max:255'
            ],
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->newsletter;
        $newsletter->save();
        $notification = array(
            'messege' => 'Newsletter Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // newsletter Category Delete
    public function delete($id){

        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return back();
    }

    // newsletter Category Edit
    public function edit($id){

        $newsletter = Newsletter::find($id);
        return view('admin.newsletter.edit', compact('newsletter'));

    }

    // Update newsletter Category
    public function update(Request $request, $id){



         $request->validate([
            'email' => [
                'required',
                'max:255'
            ],
        ]);


        $newsletter = Newsletter::find($id);


        $newsletter->email = $request->email;

        $newsletter->save();

        $notification = array(
            'messege' => 'Newsletter Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.newsletter'))->with('notification', $notification);
    }


    public function mailsubscriber() {
        return view('admin.newsletter.mail');
      }

      public function subscsendmail(Request $request) {
        $request->validate([
          'subject' => 'required',
          'message' => 'required'
        ]);

        $sub = $request->subject;
        $msg = $request->message;

        $subscs = Newsletter::all();

        $be = Emailsetting::first();


          $mail = new PHPMailer(true);



          if ($be->is_smtp == 1) {
              try {


                  $mail->isSMTP();
                  $mail->Host       = $be->smtp_host;
                  $mail->SMTPAuth   = true;
                  $mail->Username   = $be->smtp_user;
                  $mail->Password   = $be->smtp_pass;
                  $mail->SMTPSecure = $be->email_encryption;
                  $mail->Port       = $be->smtp_port;

                  //Recipients
                  $mail->setFrom($be->from_email, $be->from_name);

                  foreach ($subscs as $key => $subsc) {
                      $mail->addAddress($subsc->email);
                  }




              } catch (Exception $e) {
                  // die($e->getMessage());
              }
          } else {
              try {

                  //Recipients
                  $mail->setFrom($be->from_email, $be->from_name);
                  foreach ($subscs as $key => $subsc) {
                      $mail->addAddress($subsc->email);     // Add a recipient
                  }

              } catch (Exception $e) {
                  // die($e->getMessage());
              }
          }

          $mail->isHTML(true);
          $mail->Subject = $sub;
          $mail->Body    = $msg;

          $mail->send();

          $notification = array(
            'messege' => 'Mail sent successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
      }


}
