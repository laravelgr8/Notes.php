Session check by Middleware:-

First You create a middle ware:-

On Controller:-
function login(Request $request)
{
    $email=$request->email;
    $password=$request->password;
    $data=DB::table('users')->where(['email'=>$email,'password'=>$password])->select('name','email')->first();
    // return $data;
    if($data)
    {
        $request->session()->put('user',$email);
        // return $request->session()->get('user');
        return redirect('admin/dashboard');
    }
    else
    {
        return "Not";
    }
}



php artisan make:middleware CustomAuth;
now go to CustomAuth.php middleware
import
use Illuminate\Http\Request;
use Session;
public function handle(Request $request, Closure $next)
{
    // echo "Hello";
    // $request->session()->has('user')
    // $path=$request->path();

    if(!session('user'))
    {
        return redirect()->route('user.index');
    }
    
    return $next($request);
}


Now go to kernel.php
'myauth'=>[
    \App\Http\Middleware\CustomAuth::class,
],


Now on route:-
Route::get('admin/login', function () {
    if(Session::has('user'))
    {
        return view('admin.dashboard');
    }
    return view('admin.login');
})->name('user.index');

Route::group(['middleware'=>'myauth'],function(){
    Route::view('/admin/register','admin.register')->name('user.register');
Route::Post('user/signup',[UserController::class,'signup'])->name('user.signup');
Route::post('user/login',[UserController::class,'login'])->name('user.login');
Route::view('/admin/dashboard','admin.dashboard')->name('user.dashboard');
});
