function signup(Request $req)
{
  $validatedata=$req->validate([
    "name"=>'required',
    "email"=>'required',
    "mobile"=>'required'
  ]);
  $data=DB::table('login')->insert($validatedata);
  $req->session()->flash('msg','Insert Success');
  return redirect('home');
}

On View:-
@if(session('msg'))
<h2>{{session('msg')}}</h2>
@endif
