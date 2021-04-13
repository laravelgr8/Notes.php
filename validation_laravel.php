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
