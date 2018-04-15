<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\User;
use App\Perfil;
use Illuminate\Http\Response;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\Client;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use App\Exceptions\APIException;

class UserController extends Controller {

    function __construct() {
        $this->content = array();
    }

    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();                        
            //$this->content['token'] = $user->clients();
            //$this->content['token'] = $user->createToken('app_uiatra')->accessToken;
//            $cli = new ClientRepository();
//            
//            $c = $cli->activeForUser($user->id)->first();
//            
//            
//            
//            $tkr = new TokenRepository();
//            
//            $tk = $tkr->getValidToken($user, $c);
            //$tk = $tkr->findValidToken($user, $c);
            
            
            
            //$this->content['client'] = $c;
            
           // $this->content['token'] = $tk;
            $this->content['usuario'] = $user;
            $this->content['perfil'] = $user->perfil()->get()->first();
            $this->content['logado'] = true;
            
            //$this->content['token'] = $user->createToken('app_uiatra')->token;
            $this->content['token'] = $user->createToken('app_uiatra')->accessToken;
            $status = 200;
        } else {
            $this->content['error'] = "Login não autorizado.";
            $this->content['message'] = "E-mail ou senha informado inválido.";
            $status = 401;
        }
        return response()->json($this->content, $status);
    }
    
    public function addUsuario(Request $request)
    {
        $validator = $this->validator($request->all());
        
        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        event(new Registered($user = $this->create($request->all())));
        
        return response()->json($user,200);
    }
    
    public function editUsuario(Request $request, User $user)
    {
        $validator = $this->validatorUpdate($request->all(), $user);
        
        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $data = $request->all();
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->id_perfil = $data['id_perfil'];
        
        if ($request->has('password')) {
            $user->password = bcrypt($data['password']);
        }
        
        $user->save();

        //event(new Registered($user = $this->create($request->all())));
        
        return response()->json($user,200);
    }
    
    public function changePasswordUsuario(Request $request, User $user)
    {
        $validator = $this->validatorChangePassword($request->all(), $user);
        
        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $data = $request->all();      
                        
        if ($request->has('password')) {
            $user->password = bcrypt($data['password']);
        }
        
        $user->save();

        //event(new Registered($user = $this->create($request->all())));
        
        return response()->json($user,200);
    }
    
    public function listUsuario() {
        $user = User::all();
        return response()->json($user, 200);
    }
    
    public function listPerfil() {
        $perfil = Perfil::all();
        return response()->json($perfil, 200);
    }
    
    public function findPerfil(Perfil $perfil) {        
        return response()->json($perfil, 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 200);
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'id_perfil' => 'required',
        ]);
    }
    
    protected function validatorChangePassword(array $data)
    {
        return Validator::make($data, [                        
            'password' => 'required|string|min:6|confirmed',            
        ]);
    }
    
    protected function validatorUpdate(array $data,User $user)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',            
            'email' => ['required',
                           'string',
                           'email',
                           Rule::unique('users')->ignore($user->id),
                           'max:255'],            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        $user = new User();
//        $user->fill($data);
//        $user->save();
//        return->$user;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'id_perfil' => $data['id_perfil'],
        ]);
    }
    
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        $mensagem = $response == Password::RESET_LINK_SENT ? 'e-mail enviado para '.$request['email'] : 'e-mail ' . $request['email'] . ' não encontrado.';
        return Response()->json($mensagem, 200);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

}
