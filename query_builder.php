For Insert:-
function insert(Request $req)
{
	$data=array(
		"name"=>$req->name,
		"email"=>$req->email
	);
	$result=DB::table('records')->insert($data);
	return redirect('home');  		
}

==================
How to get Last Insert ID:-
function insert(Request $req)
{
	$data=array(
		"name"=>$req->name,
		"email"=>$req->email
	);
	$result=DB::table('records')->insertGetId($data);
	echo $result;  		
}

================================================
Get:-
function show()
{
	$data=DB::table('records')->get();
	return view('home',["data"=>$data]);
}
================================================
where:-
function show()
{
	$data=DB::table('records')->where('name','suman')->get();
	return view('home',["data"=>$data]);
}
================================================
orWhere():-
function show()
{
	$data=DB::table('records')->orWhere('name','neha')->orWhere('name','suman')->get();
	return view('home',["data"=>$data]);
}

where and orWhere both:-
function show()
{
	$data=DB::table('records')->where('name','suman')->orWhere('name','neha')->get();
	return view('home',["data"=>$data]);
}
==================================================
whereBetween:-
function show()
{
	$data=DB::table('records')->whereBetween('id',[20,40])->get();
	return view('home',["data"=>$data]);
}
===================================================
whereNotBetween:-
function show()
{
	$data=DB::table('records')->whereNotBetween('id',[20,40])->get();
	return view('home',["data"=>$data]);
}
===================================================
whereIn:-
function show()
{
	$data=DB::table('records')->whereIn('id',[20,40])->get();
	return view('home',["data"=>$data]);
}
==================================================
function show()
{
	$data=DB::table('records')->where('name','suman')->orWhere(function($query){
	$query->where('name','test')
		  ->where('id','<',5)	
		})->get();
	return view('home',["data"=>$data]);
}

//select * from records where name='suman' or (name='test' and id<5);
=========================================================
whereDate():-
function show()
{
	$data=DB::table('records')->whereDate('created_at','2021-3-7')->get();
	return view('home',["data"=>$data]);
}
=======================================================
whereMonth():-
march month ka full record chahe year koi v ho. agar sirf 2021 ka chahiye to whereYear condition ka use kare
function show()
{
	$data=DB::table('records')->whereMonth('created_at','3')->get();
	return view('home',["data"=>$data]);
}
==========================================================
whereDay():-
function show()
{
	$data=DB::table('records')->whereDay('created_at','21')->get();
	return view('home',["data"=>$data]);
}
==========================================================
whereYear():-
whereDay():-
function show()
{
	$data=DB::table('records')->whereYear('created_at','2021')->get();
	return view('home',["data"=>$data]);
}
==========================================================
whereTime():-
whereDay():-
function show()
{
	$data=DB::table('records')->whereTime('created_at','11:46:03')->get();
	return view('home',["data"=>$data]);
}
==========================================================
whereColumn:-
two table ko compaire karne ke liye use karte hai
whereDay():-
function show()
{
	$data=DB::table('records')->whereColumn('updated_at','>','created_at')->get();
	return view('home',["data"=>$data]);
}
==========================================================
first():-
function show()
{
	$data=DB::table('records')->where('name','suman')->first();
	echo $data->name;
}
==========================================================
find():-
function show()
{
	$data=DB::table('records')->find(4);
	echo $data->name;
}
============================================================
value and pluck read
===========================================================
select():-
function show()
{
	$data=DB::table('records')->select('name','email')->get();
	return view('home',["data"=>$data]);
}
==========================================================
selectAdd:-
function show()
{
	$data=DB::table('records')->select('name','email');
	$data2=$data->addSelect('password')->get();
	return view('home',["data"=>$data2]);
}
===========================================================



first:- one record show
$data=DB::table('login')->where('name','suman')->first();
echo $data->name;
===============================================================

value :- sirf one column ka record fetch karta hai condition use kar sakte hai. otherwise last ka record fetch karega.
$data=DB::table('login')->where('id',1)->value('email'); 	
echo $data;

=============================================================
find:- for id
ex:-
$data=DB::table('login')->find(3);
return $data->name;
=============================================================

pluck:- one column ke sara record fetch karta hai
$data = DB::table('login')->pluck('name');
foreach ($data as $record) {
    echo $record;
}
======================================================================


Count:-
$data=DB::table('login')->count('name');
return $data;

or

$data=DB::table('login')->where('name','suman')->count('name');
return $data;
==============================================================================


Specifying A Select Clause:-
$data=DB::table('login')
		->select('name','email')
		->get();

foreach($data as $rec)
{
	echo $rec->name;
}
===========================================================================
Inner Join:-
function show()
{
$data=DB::table('login')
		 ->join('student','student.empid','=','login.id')
		 ->get();
return view('home',["data"=>$data]);	
}
		
==============================================================================
Left Join:- left table ka all record(login)
function show()
{
$data=DB::table('login')
		 ->leftJoin('student','student.empid','=','login.id')
		 ->get();
return view('home',["data"=>$data]);	
}
==============================================================================
Cross Join:- ont to one
function show()
{
$data=DB::table('login')
		 ->crossJoin('student')
		 ->get();
return view('home',["data"=>$data]);	
}
==============================================================================
