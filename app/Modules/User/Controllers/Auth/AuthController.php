<?php

namespace App\Modules\User\Controllers\Auth;

use Illuminate\Http\Request;
use App\Modules\User\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Mail;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Intervention\Image\Facades\Image;
use Kamaln7\Toastr\Facades\Toastr;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectPath = '/user' ;
    protected $loginPath = '/user/login';


    public function authenticate(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

         $credentials = [
            'email' => $request->input('email'),
            'password' =>$request->input('password'),
            'status' => 1
        ];


        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticatedHacked($request, $throttles);
        }

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => Toastr::warning('Verify it', 'test', $options = []),
            ]);
    }

    protected function handleUserWasAuthenticatedHacked(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }
        //intended($this->redirectPath())
        return redirect()->back();
    }

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }


    protected function create(array $data)
    {
        $image = $data['imagepath'];
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $url = url('/');
        $imagepath = $url . '/storage/uploads/users/' . $filename;
        $path = public_path('/storage/uploads/users/' . $filename);


        Image::make($image->getRealPath())->resize(200, 200)->save($path);
        $v_code = str_random(30);
        $mail_content = array( 'code' => $v_code );

        Mail::send('User::mail.validate', $mail_content, function($message) use ($data) {
            $message->to($data['email'], $data['nom'])
                ->subject('Verify your email address');
        });
//shoudl return homepage with a toastr to activate
        return User::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'imagepath' => $imagepath,
            'validation' => $v_code,
            'datenaissance' => $data['datenaissance'],

        ]);

    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

        $providerData = Socialite::driver($provider)->user();
        $user = User::where('provider_id', '=', $providerData->id)
            ->orWhere('email', '=' ,$providerData->email)
            ->first();
        if ($providerData->name == null){
            $nom = strtok($providerData->email, '@');
        } else {
            $nom=$providerData->name;
        }

        $SocialData = [
            'provider_id' => $providerData->id,
            'provider' => $provider,
            'email' => $providerData->email,
            'nom' => $nom,
            'status' => 1,
            'imagepath' => $providerData->avatar,
        ];

        if(!$user) {
            $user = User::create($SocialData);
        }

        $dbData = [
            'imagepath' => $user->imagepath,
            'email' => $user->email,
            'nom' => $user->nom,
            'provider' => $user->provider,
            'provider_id' => $user->provider_id,
        ];

        if (!empty(array_diff($SocialData, $dbData))) {
            $user->imagepath = $providerData->avatar;
            $user->email = $providerData->email;
            $user->nom = $nom;
            $user->provider = $provider;
            $user->provider_id = $providerData->id;
            $user->save();
        }

        Auth::login($user);

        return redirect($this->redirectPath())->with( Toastr::warning('Verify it', 'test', $options = []));
    }

}
