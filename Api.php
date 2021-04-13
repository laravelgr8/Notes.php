Api Start:-47
small api:
first create a controller
now go to route->api.php and call controller
use App\Http\Controllers\User;

create route:-
Route::get('data',[User::class,'getData']);

On Controller:
function getData()
{
	return ["name"=>"suman","email"=>"suman@gmail.com","address"=>"patna"];
}

Go To postman
http://127.0.0.1:8000/api/data
=====================================================

Get Data with api:- 48
first create a controller
now go to route->api.php and call controller
use App\Http\Controllers\User;

create route:-
Route::get('data',[User::class,'getData']);

Create Model :
and claa model on controller
use App\Models\Record;//model load

On Controller:
function getData()
{
	return record::all();
}

run on postman 
http://127.0.0.1:8000/api/data
=======================================================

Get Data with parameter:- 49
first create a controller
now go to route->api.php and call controller
use App\Http\Controllers\User;

create route:-
Route::get('data/{id?}',[User::class,'getData']);

Create Model :
and claa model on controller
use App\Models\Record;//model load

On Controller:
function getData($id=null)
{
	return $id?record::find($id):record::all();
}

run on postman 
http://127.0.0.1:8000/api/data

========================================================


POST Method:- 50
first create a controller
now go to route->api.php and call controller
use App\Http\Controllers\User;

On Route:-
Route::post('add',[User::class,'add']);

Create Model :
and claa model on controller
use App\Models\Record;//model load

On Controller:
function add(Request $req)
{
	$record=new Record;
	$record->name=$req->name;
	$record->email=$req->email;
	$record->password=$req->password;
	$result=$record->save();
	if($result)
	{
		return ["result"=>"Insert Success"];
	}
	else
	{
		return ["result"=>"Insert Not Success"];
	}
}

On Postman
http://127.0.0.1:8000/api/add/
on header
Content-Type:application/json
on body
{
	"name":"neeraj",
	"email":"neeraj@gmail.com",
	"password":"1587456"
}
===============================================

Put Method:- 51
first create a controller
now go to route->api.php and call controller
use App\Http\Controllers\User;

On Route:-
Route::put('update',[User::class,'update']);

Create Model :
and claa model on controller
use App\Models\Record;//model load

On Controller:-
function update(Request $req)
{
	$record=Record::find($req->id);
	$record->name=$req->name;
	$record->email=$req->email;
	$record->password=$req->password;
	$result=$record->save();
	if($result)
	{
		return ["result"=>"Update Success"];
	}
	else
	{
		return ["result"=>"Update Not Success"];
	}
}

On Postman
http://127.0.0.1:8000/api/update/
on header
Content-Type:application/json
on body
{
	"id":4,
	"name":"neeraj",
	"email":"neeraj@gmail.com",
	"password":"1587456"
}

====================================================

delete method:- 52
first create a controller
now go to route->api.php and call controller
use App\Http\Controllers\User;

On Route:-
Route::delete('delete/{id}',[User::class,'delete']);

Create Model :
and call model on controller
use App\Models\Record;//model load

On Controller
function delete($id)
{
	$record=Record::find($id);
	$result=$record->delete();
	if($result)
	{
		return ["result"=>"Delete Success"];
	}
	else
	{
		return ["result"=>"Delete Not Success"];
	}
}

On Postman:-
http://127.0.0.1:8000/api/delete/41
on header
Content-Type:application/json
====================================================
