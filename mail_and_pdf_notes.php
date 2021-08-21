
How to send mail:-
first you create a view file in view folder like mail.php
views->mail.blade.php
<h2>Welcome</h2>

Change on env file.
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=theequicomgr8@gmail.com
MAIL_PASSWORD=nehaneshi
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=theequicomgr8@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

import mail on controller.
use Mail;

on controller:
 $dat=["name"=>"suman"];
 $user['to']='suman.krgr8@gmail.com';
 Mail::send('mail',$dat,function($msg) use($user){
     $msg->to($user['to']);
     $msg->subject('Testing');
 });
return redirect()->route('home')->with('msg','Insert Success');
--------------------
how to create a global helper for mail:-
first you create a file on app folder
app->mail.php
<?php
if(!function_exists('mailhelper'))
{
    function mailhelper()
    {
        $dat=["name"=>"suman"];
        $user['to']='suman.krgr8@gmail.com';
        Mail::send('mail',$dat,function($msg) use($user){
            $msg->to($user['to']);
            $msg->subject('Testing');
        });
        return redirect()->route('home')->with('msg','Insert Success');
        
    }
}
?>

create a fiew file.
views->mail.php
<h2>Helocom to My Company</h2>

On composer.json autoload section.
"files":[
    "app/mail.php"
],

Now where you use this helper only call like this
return mailhelper();

final run a command
composer dump-autoload

--------------------
How to create pdf :-
step 1:
run this command.
composer require barryvdh/laravel-dompdf

Step 2
go to config/app.php
providers section and write this code in last position.
Barryvdh\DomPDF\ServiceProvider::class,

aliases section and write this code in last position.
'PDF' => Barryvdh\DomPDF\Facade::class,

On controller:-
Import PDF.
use \PDF;

$pdf=PDF::loadView('mail'); //here mail is a view file
$path=public_path('pdf/');
$filename='document.pdf';
$pdf->save($path.'/'.$filename);
return $pdf->download($filename);
---------------------------------
How to send Email with attachment:-
step 1:
run this command.
composer require barryvdh/laravel-dompdf

Step 2
go to config/app.php
providers section and write this code in last position.
Barryvdh\DomPDF\ServiceProvider::class,

aliases section and write this code in last position.
'PDF' => Barryvdh\DomPDF\Facade::class,

On controller:-
Import PDF.
use \PDF;
use \Mail;

$pdf=PDF::loadView('mail');
$path=public_path('pdf/');
$filename='document.pdf';
$pdf->save($path.'/'.$filename);
$pdf->download($filename);

$dat=["name"=>"suman"];
$user['to']='suman.krgr8@gmail.com';
$files=[
    public_path('pdf/document.pdf')
];
Mail::send('mail',$dat,function($msg) use($user,$files){
    $msg->to($user['to']);
    $msg->subject('Testing');
    foreach($files as $file)
    {
        $msg->attach($file);
    }
});
return back()->with('msg','Insert Success');
