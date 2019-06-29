<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    //  Función para redirección según tipo de usuario
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('admin')) {
            //  Si el usuario es administrador se dirige a la vista de administrador.
            $redirectTo = '/admin/home';  
        }
        if (auth()->user()->hasRole('profesor')) {
            //  Si el usuario es profesor se dirige a la vista de profesor.
            $redirectTo = '/profesor/home';
        }
        if (auth()->user()->hasRole('revisor')) {
            //  Si el usuario es revisor se dirige a la vista de revisor.
            $redirectTo = '/revisor/home';
        }
        if (auth()->user()->hasRole('dac')) {
            //  Si el usuario es dac se dirige a la vista de dac.
            $redirectTo = '/dac/home';
        }
        
        return $redirectTo;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}