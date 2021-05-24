function signup(Request $req)
{
  $validatedData = $req->validate([
            'name' => 'required|alpha|between:5,100|unique:login,name',
            'email' => 'required|email|unique:login,email',
            'mobile'=> 'required|regex:/[6789][0-9]{9}/'
        ]);
  $data=DB::table('login')->insert($validatedData);
  return redirect('home');
}


error show on view:-
@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
=========================================
Full validation (Also checkbox)
function add(Request $request)
	{

		// $result=$request->all();
		$request->validate([
			"name"=>"required",
			"email"=>"required",
			"password"=>"required",
			"gender"=>"required",
			"qualification"=>"required",
			"pic"=>"required"
		]);
		// $result["qualification"]=implode(",", $request->qualification);
		if($request->hasfile('pic'))
		{
			$file=$request->file("pic");
			$extension=$file->getClientOriginalExtension();
			$filename=time().".".$extension;
			$file->move("img/",$filename);
			$pic=$filename;
		}
		$result=array(
			"name"=>$request->name,
			"email"=>$request->email,
			"password"=>$request->password,
			"gender"=>$request->gender,
			"qualification"=>implode(",", $request->qualification),
			"pic"=>$pic
		);
		$data=DB::table("records")->insert($result);
		return redirect("home");
	}
