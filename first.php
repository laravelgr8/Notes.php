Valu Pass By Controller:-
Route::get('user/{id}',[User::class,'show']);

function show($id)
{
	return $id;
}


Value Pass By View:-

Route::get('/homes/{name}',function($name){
	return view('home',["name"=>$name]);
});

{{$name}}

=========================================
View Call By Controller:-
function show()
{
	return view('home');
}

Route::get('user',[User::class,'show']);

Value Pass:
function show($name)
{
	return view('home',["name"=>$name]);
}

Route::get('user/{name}',[User::class,'show']);

{{$name}}
===========================================



How to Use If:- 9
function loadView()
{
	return view('home',["name"=>"Neha"]);
}

Route::get('user',[User::class,'loadView']);

@if($name=='Neha')
<h2>Hello {{$name}}</h2>
@elseif($name=='Suman')
<h2>Hello {{$name}}</h2>
@else
<h2>Default name</h2>
@endif




How to use for loop:-
@for($i=0;$i<=5;$i++)
<h4>{{$i}}</h4>
@endfor



How to Use forech loop:-
function loadView()
{
	$data=["Neha","Suman","Micki","Dolly"];
	return view('home',['name'=>$data]);
}

Route::get('user',[User::class,'loadView']);

@foreach($name as $v)
<h2>{{$v}}</h2>
@endforeach
========================================


How to Include anoter view in view page:- 10
@include('home2')

How To php code write in JS:-
function loadView()
{
	$data=["Neha","Suman","Micki","Dolly"];
	return view('home',['name'=>$data]);
}
//controller load by route
Route::get('user',[User::class,'loadView']);

//on view page
<script>
var a=@json($name);
console.log(a);
</script>


How to use csrf:-
@csrf

=====================================

Form data Recive:-11
<h1>User Login</h1> 
<!-- action route se url liya hu -->
<form method="post" action="user">
@csrf
<input type="text" name="name">
<br><br>
<input type="password" name="password">
<br><br>
<input type="submit" name="submit">
</form>

Route::view('home','home');//view load

//controller load
Route::post('user',[User::class,'getData']);

//Controller function
function getData(Request $req)
{
	return $req->input();
}
========================================

Global Middleware:- 12.1
First Create Middleware:
php artisan make:middleware ageCheck

goto Kernel.php and active middleware
\App\Http\Middleware\ageCheck::class,

Now Goto middleware
if($request->age && $request->age <18)
{
    return redirect('noaccess');
}

On Route Load all View:-
Route::view('home','home');
Route::view('home2','home2');
Route::view('noaccess','noaccess');

=======================================

Group Middleware:- 12.2
First Create Middleware:
php artisan make:middleware ageCheck

goto Kernel.php and active middleware
On Group Route
after api
'proctedPage'=>[
    \App\Http\Middleware\ageCheck::class,
]

Now Goto middleware
if($request->age && $request->age <18)
{
    return redirect('noaccess');
}


On Route Load all View:-
Route::view('home','home');
Route::view('noaccess','noaccess');
//sirf home2 par middleware apply ho
Route::group(['middleware'=>['proctedPage']],function(){
	Route::view('home2','home2');
});

===========================================

Route Middleware:-13
First Create Middleware:
php artisan make:middleware ageCheck

goto Kernel.php and active middleware
On route middleware
'protectedPage' => \App\Http\Middleware\ageCheck::class,


Now Goto middleware
if($request->age && $request->age <18)
{
    return redirect('noaccess');
}

On Route Load all View:-
Route::view('home','home');
Route::view('home2','home2')->middleware('protectedPage');
Route::view('noaccess','noaccess');

=============================================

Database Connection:- 14
First go to .env file
============================================
Data Fetch By Controller without model:-

Go to Controller and import db
use Illuminate\Support\Facades\DB;

function index()
{
	return DB::select('select * from login');
}

==============================================
Model:-15
Modal ka name or table ka name same hona chahiye.
Notes:-table name plurals hona chahiye
if table name= users then
model name =user

Create Model:
php artisan make:model model_name

Model Import on controller:
use App\Models\record;

function getData()
{
	return record::all();
	//here record is my table name and all function hai 
}

Route::get('user',[User::class,'getData']);

=========================================
Agar koi or table ko access karna ho to
goto model
class record extends Model
{
    use HasFactory;
    public $table='records';
} 
=======================================

HTTP Client :- 16
Api data ko retrive ke liye

First Load HTTP On Controller
use Illuminate\Support\Facades\Http;

function index()
{
    $data=Http::get('http://localhost/practice/codeigniter/API/api/Student/index_get');

    return view('home',['data'=>$data['data']]);
    //['data'] show on json record
}

Now go on View:
<table border="1">
@foreach($data as $item)
<tr>
	<td>{{$item['id']}}</td>
	<td>{{$item['name']}}</td>
	<td>{{$item['email']}}</td>
</tr>
@endforeach
</table>
=========================================

Http Request Method:- 17
GET,POST,PUT,DELETE

First Create A View page and call by route
Route::view('home','home');
Route::get('test',[User::class,'test']);

Create View
<form action="test" method="get">
	<input type="text" name="name"><br><br>
	<input type="submit" name="">
</form>

On Controller:
function test()
{
    echo "form Submit By GET";
}
============================================
Agar PUT or delete Ka use karna ho:-
Create View
<form action="test" method="post">
	{{method_field('PUT')}}
	<input type="text" name="name"><br><br>
	<input type="submit" name="">
</form>
Route::put('test',[User::class,'test']);
============================================

Session():-18
Go on view:-
<form action="login" method="post">
	@csrf
	<input type="text" name="name"><br><br>
	<input type="password" name="password"><br><br>
	<input type="submit" name="">
</form>

Go On Controller:
function login(Request $req)
{
    $data= $req->input('name');
    $req->session()->put('name',$data);
    return redirect('profile');
}

Go On Profile:
<h2>Hello {{session('name')}}</h2>
<a href="logout">Logout</a>

On Route:
//login hone ke bad phir se login par na jaye
Route::get('/home', function () {
    if(session()->has('name'))
    {
    	return redirect('profile');
    }
    return view('home');
});

Route::view('profile','profile');
Route::post('login',[User::class,'login']);

//for logout name me session store hai
Route::get('/logout', function () {
    if(session()->has('name'))
    {
    	session()->pull('name',null);
    }
    return redirect('home');
});

==================================================

Flash Session : - 19
Flash session page refresh ke bad end ho jata hai
On Controller:
function login(Request $req)
{
    $data= $req->input('name');
    $req->session()->flash('name1',$data);
    return redirect('home');
}

On View:
@if(session('name1'))
<h4>Data Insert For {{session('name1')}}</h4>
@endif
=================================================

File Upload:- 20
File Store path:-
storage->app->img
<form action="upload" method="post" enctype="multipart/form-data">
	@csrf
	<input type="file" name="pic"><br><br>
	<input type="submit" name="">
</form>

On Controller:
function upload(Request $req)
{
    return $req->file('pic')->store('img');
    //img is folder name 
}

On Route:
Route::view('home','home');
Route::post('upload',[User::class,'upload']);

=====================================================

Localization :-21
For Multilanguage
Currentally not read

=====================================================

Data insert:- 22
first create form:
<form action="insert" method="post">
	@csrf
	<input type="name" name="name"><br><br>
	<input type="email" name="email"><br><br>
	<input type="password" name="password"><br><br>
	<input type="submit" name="">
</form>

On Route:
Route::view('home','home');
Route::post('insert',[User::class,'datasave']);

Create A Model:
model ka name or table name same
ex:- table name='records'
model name='record'

go to model:
Agar extra column add na kare:
class record extends Model
{
    use HasFactory;
    // public $table='login';
    public $timestamps=false;
}

Now to on Controller:
imporl model on controller
use App\Models\record;
function datasave(Request $req)
{
    $record=new record;
    $record->name=$req->name;
    $record->email=$req->email;
    $record->password=$req->password;
    $record->save();
    return redirect('home');
}
=========================================================

How to Css And JS call:-
firct file put in public folder
src="{{asset('js/jquery.js')}}"
=========================================================
Data Insert By Ajax:-
$("#insertform").on("submit",function(e){
e.preventDefault();
$.ajax({
	url:"{{url('signup')}}",
	type:'POST',
	data:new FormData(this),
	contentType:false,
	cache:false,
	processData:false,
	success:function(data)
	{
		alert('Insert Success');
	}
});
});
========================================================
How to Data show:- 24
First import model on controller
use App\Models\record;
function show()
{
	$data= record::all();
	return view('home',['data'=>$data]);
}

On view:-
<table border="1">
@foreach($data as $item)
<tr>
	<td>{{$item['id']}}</td>
	<td>{{$item['name']}}</td>
	<td>{{$item['email']}}</td>
	<td>{{$item['password']}}</td>
</tr>
@endforeach
</table>

========================================================
Pagination :- 23
On Controller:
function show()
{
	$data= record::paginate(5);
	return view('home',['data'=>$data]);
}

On View:
<table border="1">
	@foreach($data as $item)
	<tr>
		<td>{{$item['id']}}</td>
		<td>{{$item['name']}}</td>
	</tr>
	@endforeach
</table>

<div >{{$data->links()}}</div>
<style>
.w-5
{
	display: none;
}
</style>
=======================================================

Data Delete:-
pahle data show hoga or jaha delete ka anchor tag banega ye code rahega
<a href="{{'delete/'.$item['id']}}">Delete</a>

Or Route:
Route::get('delete/{id}',[User::class,'delete']);

On Controller:
function delete($id)
{
	$data=record::find($id);
	$data->delete();
	return redirect('user');
}
==========================================================
For Update:-
<table border="1">
@foreach($data as $item)
<tr>
	<td>{{$item['id']}}</td>
	<td>{{$item['name']}}</td>
	<td><a href="{{'edit/'.$item['id']}}">Edit</a></td>
</tr>
@endforeach
</table>

On Route:
Route::get('edit/{id}',[User::class,'edit']);
Route::post('update',[User::class,'update']);

On Controller:
function edit($id)
{
	$data= record::find($id);
	return view('edit',['data'=>$data]);
}

function update(Request $req)
{
	$data=record::find($req->id);
	$data->name=$req->name;
	$data->save();
	return redirect('user');
}

Edit.blade.php:
<form method="POST" action="/update">
@csrf
<input type="hidden" name="id" value="{{$data['id']}}">
Name :<input type="text" name="name" value="{{$data['name']}}"><br>
<input type="submit" name="" value="Update">
</form>
======================================================
Query Builder:- 26

Show All record:
First load db on controller:
use Illuminate\Support\Facades\DB;

function show()
{
	$data= DB::table('record')->get();
	retuen view('home',["data"=>$data]);
}

On View:-
@foreach($data as $item)
<tr>
	<td>{{$item->name}}</td>
</tr>
@endforeach
=======================================================
Show Single record:-

function show()
{
	return DB::table('record')
	->where('id',4)
	->get();
}
======================================================
Show Single record:-
second method
function show()
{
	return (array)DB::table('record')->find(4);
}
======================================================
Count:-
function show()
{
	return DB::table('record')->count();
}
=====================================================
Insert By Query Builer:-
function show()
{
	return DB::table('record')
	->insert([
		"name"=>"suman",
		"email"=>"s@gmail.com"
	]);
}
=====================================================
Update By Query Builer:-
function show()
{
	return DB::table('record')
	->where("id",4)
	->update([
		"name"=>"suman",
		"email"=>"s@gmail.com"
	]);
}
=====================================================
Delete By Query Builer:-
function show()
{
	return DB::table('record')
	->where("id",4)->delete();
}
=====================================================
Aggregate function:-27
function add()
{
	return DB::table('record')->sum('id');
}
=====================================================
Join:- 28
function show()
{
	return DB::table('employee')
	->join('company','employee.id=company.emp_id')
	//->select('*')
	//->where()
	->get();
}
====================================================

//for image insert and show:-

function signup(Request $req)
{
$record=new record;
$record->name=$req->input('name');
$record->email=$req->input('email');
$record->password=$req->input('password');
// $record->pic=$req->file('pic')->store('js');
if($req->hasfile('pic'))
{
	$file=$req->file('pic');
	$extension=$file->getClientOriginalExtension();
	$filename=time().'.'.$extension;
	$file->move('js/',$filename);
	$record->pic=$filename;
}
else
{
	return $req;
	$record->pic='';
}
$record->save();
}


for show:-
function show()
{
    $data= record::all();
    return view('home',["data"=>$data]);
}
<img src="{{asset('js/'.$item['pic'])}}">

====================================================
Get Path Function:-

base_path();
app_path();
public_path();
storage_path()
storage_path('app')


====================================================
Migration :- 29
Iska use database me table banane ke liye karte hai
First Create A migration:
php artisan make:migration create_test_table

Now goto database->migration
Open your file
for create table go to up function
$table->string('name');
$table->string('email');

Now goto cmd and type
php artisan migrate
check database
	
For Rollback:
php artisan migrate:rollback
php artisan migrate:rollback --step=5	

Drop All Tables & Migrate:
php artisan migrate:fresh
php artisan migrate:fresh --seed
	
How to column make unique and null:
$table->string('email')->nullable()->unique();
-------------------------------------------------

Migrat ke through bana huaa table delete kase kare:-30
php artisan migrate:reset
