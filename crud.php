On Controller:-
function signup(Request $req)
    {
    	$validatedata=$req->validate([
    		"name"=>'required',
    		"email"=>'required',
    		"password"=>'required'
    	]);
    	$data=DB::table('login')->insert($validatedata);
    	$req->session()->flash('msg','Insert Success');
    	return redirect('home');
    }

    function show()
    {
    	$data=DB::table('login')
    			 
    			 ->get();
    	return view('home',["data"=>$data]);	
    }

    function edit($id)
    {
    	$data=	DB::table('login')
    				->find($id);
    	return view('edit',["data"=>$data]);
    }

    function update(Request $req)
    {
    	$id=$req->id;
    	$name=$req->name;
    	$email=$req->email;
    	$data=DB::table('login')
    				->where('id',$id)
    				->update([
    					"name"=>$name,
    					"email"=>$email
    				]);
    	return redirect('home');
    }

    function delete($id)
    {
    	$data=DB::table('login')->where('id',$id)->delete();
    	return redirect('home');
    }
    
    
    
    =============================
    view:-
    home.php
    <div class="col-xl-6">
		<form method="post" action="insert">
			@csrf
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" class="form-control">
				@error('name')
				<h4>{{$message}}</h4>
				@enderror
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input type="text" name="email" class="form-control">
				@error('email')
				<h4>{{$message}}</h4>
				@enderror
			</div>
			<div class="form-group">
				<label>Password : </label>
				<input type="password" name="password" class="form-control">
				@error('password')
				<h4>{{$message}}</h4>
				@enderror
			</div>

			<input type="submit" name="" class="btn btn-info">
		</form>
	</div>
	
	<table class="table">
		@foreach($data as $dat)
		<tr>
			<td>{{$dat->name}}</td>
			<td>{{$dat->email}}</td>
			<td>{{$dat->password}}</td>
			<td><a href="{{'edit/'.$dat->id}}">Edit</a></td>
			<td><a href="{{'delete/'.$dat->id}}">Delete</a></td>
		</tr>
		@endforeach
	</table>
  
  =====================
  
  
  
  edit.php
  <form method="post" action="/update">
			@csrf
			<input type="hidden" name="id" value="{{$data->id}}">
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" class="form-control" value="{{$data->name}}">
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input type="text" name="email" class="form-control" value="{{$data->email}}">
			</div>
			<input type="submit" name="" class="btn btn-info">
		</form>
