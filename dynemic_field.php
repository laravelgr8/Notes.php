View:-
home.blade.php
<div class="container">
	<div class="col-xl-6">
		<form id="myform">
			@csrf
			<table id="muform">
				<tr>
					<td>Name1 : <input type="text" name="name[]" id="name" class="form-control"></td>
					<td>Email : <input type="text" name="email[]" id="email" class="form-control"></td>
					<td><br><button class="btn btn-info" id="add">Add</button></td>
				</tr>
			</table>
			<input type="submit" name="" value="Insert" class="btn btn-info">
		</form>
	</div>
</div>
<!-- model for insert end -->


<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function(){
		var i=1;
		$("#add").click(function(e){
			e.preventDefault();
			i++;
			$("#muform").append('<tr id="row'+i+'"><td>Name1 : <input type="text" name="name[]" id="name" class="form-control"></td><td>Email : <input type="text" name="email[]" id="email" class="form-control"></td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>');
		});


		$(document).on("click",'.remove',function(e){
			e.preventDefault();
			var id=$(this).attr('id');
			$("#row"+id).remove();
		});


		$("#myform").on("submit",function(e){
			e.preventDefault();
			$.ajax({
				url: '/insert',
				type: 'post',
				data:$(this).serialize(),
				dataType:'json',
				success:function(data)
				{
					console.log(data);
				}
			});
		});

	});
</script>


=================================================
Route:-
Route::view('home','home');
Route::post('insert',[User::class,'insert']);
===================================================

Controller:-
User.php

use Illuminate\Support\Facades\DB;
// use PDF;
class User extends Controller
{
    function insert(Request $req)
    {
    	
    	if($req->ajax())
    	{
  		$name=$req->name;
    		$email=$req->email;
    		for($i=0;$i<count($name);$i++)
    		{
    			$data=array(
    				"name"=>$name[$i],
    				"email"=>$email[$i]
    			);
    			$insert_data[]=$data;
    		}
    		return DB::table('records')
				->insert($insert_data);  		
    	}

    }
}
