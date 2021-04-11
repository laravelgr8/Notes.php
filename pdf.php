For PDF:-
On CMD:
composer require barryvdh/laravel-dompdf

Go To config/app.php
'providers' => [
	....
	Barryvdh\DomPDF\ServiceProvider::class,
],
  
'aliases' => [
	....
	'PDF' => Barryvdh\DomPDF\Facade::class,
]

On Controller:-
call pdf
use PDF;

public function generatePDF()
{
$data = [
    'title' => 'Welcome to Laravel',
    'date' => date('m/d/Y')
];
  
$pdf = PDF::loadView('myPDF', $data);

return $pdf->download('itsolutionstuff.pdf');
}

Or
function downloadpdf()
{
$data=DB::table('records')
				->limit(20)
				->get();
$pdf = PDF::loadView('mypdf', ["data"=>$data]);
return $pdf->download('itsolutionstuff.pdf');
}

On View:-
<h1>{{ $title }}</h1>
<p>{{ $date }}</p>
