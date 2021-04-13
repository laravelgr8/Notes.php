function signup(Request $req)
{
    $name=$req->name;
    $email=$req->email;
    $password=$req->password;
    if($req->hasfile('pic'))
    {
        $file=$req->file('pic');
        $extension=$file->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $file->move(public_path('js'),$filename);
        $pic=$filename;
    }
    else
    {
        return $req;
        $pic='';
    }
    $data=DB::table('login')->insert([
        "name"=>$name,
        "email"=>$email,
        "password"=>$password,
        "pic"=>$pic
    ]);
    $req->session()->flash('msg','Insert Success');
    return redirect('home');
}








or

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
