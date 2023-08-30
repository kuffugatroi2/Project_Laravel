<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail() {
        $to_name = 'Văn Tú';
        $to_email = 'tumartin140100@gmail.com'; // send to this email

        $data = array('title'=>'Tôi là Tú đây', 'body'=>'Mail gửi về vấn đề hàng hóa'); // body of mail.blade.php

        Mail::send('admin.Mail.send_mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('Test thử mail google'); // send this mail with subject
            $message->from($to_email, $to_name); // send from this mail
        });

        // return redirect('/')->with('message', '');
    }
}
