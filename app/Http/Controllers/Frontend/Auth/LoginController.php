<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\Auth\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\Frontend\Auth\UserSessionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;


/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if(request()->ajax()){
            // return ['socialLinks' => (new Socialite)->getSocialLinks()];
        }

        return redirect('/')->with('show_login', true);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        if($validator->passes()){
            $credentials = $request->only($this->username(), 'password');
            $authSuccess = \Illuminate\Support\Facades\Auth::attempt($credentials, $request->has('remember'));
            if($authSuccess) {
                $request->session()->regenerate();
                if(auth()->user()->active > 0){
                    if(auth()->user()->isAdmin()){
                        $redirect = 'dashboard';
                    }else{
                        $redirect = 'back';
                    }
                    auth()->user()->update([
                        'last_login_at' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ]);
                    return response(['success' => true,'redirect' => $redirect], Response::HTTP_OK);
                }else{
                    \Illuminate\Support\Facades\Auth::logout();

                    return
                        response([
                            'success' => false,
                            'message' => 'Login failed. Account is not active'
                        ], Response::HTTP_FORBIDDEN);
                }
            }else{
                return
                    response([
                        'success' => false,
                        'message' => 'Login failed. Account not found'
                    ], Response::HTTP_FORBIDDEN);
            }

        }


        return response(['success'=>false,'errors' => $validator->errors()]);

    }





    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {
        /*
         * Check to see if the users account is confirmed and active
         */
        if (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail

            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', $user->{$user->getUuidName()})]));
        } elseif (! $user->isActive()) {
            auth()->logout();
            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        // If only allowed one session at a time
        if (config('access.users.single_login')) {
            resolve(UserSessionRepository::class)->clearSessionExceptCurrent($user);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
      
       

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }

   
}
