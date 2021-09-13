function show($id=null)
    {
    	// return $id?login::find($id):login::all();
    	return $id?login::find($id):login::all();
    }

    function insert(Request $req)
    {
    	$login=new Login;
    	$login->name=$req->name;
    	$login->email=$req->email;
    	$login->password=$req->password;
    	$login->mobile=$req->mobile;
    	$login->city=$req->city;
    	$data=$login->save();
    	if($data)
    	{
    		return ["message"=>"Insert Success"];
    	}
    	else
    	{
    		return ["Message"=>"Insert faield"];
    	}
    }


    function update(Request $req)
    {
    	$login=login::find($req->id);
    	$login->name=$req->name;
    	$login->email=$req->email;
    	$login->password=$req->password;
    	$login->mobile=$req->mobile;
    	$login->city=$req->city;
    	$data=$login->save();
    	if($data)
    	{
    		return ["message"=>"Update Success"];
    	}
    	else
    	{
    		return ["Message"=>"Update faield"];
    	}
    }

    function delete_two($id)
    {
    	$login=login::find($id);
    	$data=$login->delete();
    	if($data)
    	{
    		return ["message"=>"Delete Success"];
    	}
    	else
    	{
    		return ["Message"=>"Delete faield"];
    	}
    	// on postman
    	// http://127.0.0.1:8000/api/delete/4
    }


    //for multiple delete
    function delete(Request $req)
    {
    	$data=login::destroy($req->id);  	
    	if($data)
    	{
    		return ["message"=>"Delete Success"];
    	}
    	else
    	{
    		return ["Message"=>"Delete faield"];
    	}

    	// on post man
     	//{
		  // 	"id":[11,12]
		  // }
    }





On Route:-
Route::get('show/{id?}',[UserController::class,'show']);
Route::post('insert',[UserController::class,'insert']);
Route::put('update',[UserController::class,'update']);
Route::delete('delete',[UserController::class,'delete']);//by array
Route::delete('delete/{id}',[UserController::class,'delete_two']);//by url












How to data validate in api:-

use Validator;
function test(Request $request)
{
	$rules=array(
		"memeber_id"=>'required'
	);

	$validator=Validator::make($request->all(),$rules);	
	if($validator->false())
	{
		return response()->json($validator->errors(),401);
	}
	else
	{
		//insert data here
	}
}



file upload by api:-
function upload(Request $request)
{
	$result=$request->file('file')->store('img');
	return 
}
