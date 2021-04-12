Database:-
get
where


first:- one record show
$data=DB::table('login')->where('name','suman')->first();
echo $data->name;


value :- sirf one column ka record fetch karta hai condition use kar sakte hai. otherwise last ka record fetch karega.
$data=DB::table('login')->where('id',1)->value('email'); 	
cho $data;


find:- for id
ex:-
$data=DB::table('login')->find(3);
return $data->name;


pluck:- one column ke sara record fetch karta hai
$data = DB::table('login')->pluck('name');
foreach ($data as $record) {
    echo $record;
}



Count:-
$data=DB::table('login')->count('name');
return $data;

or

$data=DB::table('login')->where('name','suman')->count('name');
return $data;



Specifying A Select Clause:-
$data=DB::table('login')
		->select('name','email')
		->get();

foreach($data as $rec)
{
	echo $rec->name;
}
