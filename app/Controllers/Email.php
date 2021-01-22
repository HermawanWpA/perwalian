<?php namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// // composer require phpmailer/phpmailer
// // use CodeIgniter\Controller;
// use CodeIgniter\Controller;

class Email extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    public function index()
    {
        $data['title'] = 'Send Email';
        echo view('email/send', $data);
    }

    public function send()
    {
        $email                = $this->request->getPost('email');
        $subject            = $this->request->getPost('subject');
        $message            = $this->request->getPost('message');

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.googlemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'cvyutakautama@gmail.com'; // silahkan ganti dengan alamat email Anda
            $mail->Password   = 'bangkuang12'; // silahkan ganti dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('cvyutakautama@gmail.com', 'Darmansyah'); // silahkan ganti dengan alamat email Anda
            $mail->addAddress('puseurjaya12@gmail.com', $email);
            $mail->addAddress('hermawanapandi0@gmail.com', $email);
            $mail->addAddress('noviapriani13@gmail.com', $email);
            $mail->addReplyTo('cvyutakautama@gmail.com', 'Darmansyah'); // silahkan ganti dengan alamat email Anda
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            session()->setFlashdata('success', 'Send Email successfully');
            return redirect()->to(site_url('email/send'));
        } catch (Exception $e) {
            session()->setFlashdata('error', "Send Email failed. Error: " . $mail->ErrorInfo);
            return redirect()->to(site_url('/'));
        }
    }
}
