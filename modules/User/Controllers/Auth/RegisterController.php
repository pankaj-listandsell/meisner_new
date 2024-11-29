<?php


	namespace Modules\User\Controllers\Auth;


	use App\Helpers\ReCaptchaEngine;
    use App\User;
    use Illuminate\Auth\Access\AuthorizationException;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Auth\Events\Verified;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\MessageBag;
    use Modules\User\Events\SendMailUserRegistered;

    class RegisterController extends \App\Http\Controllers\Auth\RegisterController
	{

	    public function register(Request $request)
        {
            if(!is_enable_registration()){
                return $this->sendError(__("You are not allowed to register"));
            }

            $rules = [
                'first_name' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'last_name'  => [
                    'required',
                    'string',
                    'max:255'
                ],
                'email'      => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users'
                ],
                'password'   => [
                    'required',
                    'string',
                    'min:6',
                    'max:255'
                ],
                //'phone'       => ['required'],
                'term'       => ['required'],
            ];
            $messages = [
                'phone.required'      => __('Phone is required field'),
                'email.required'      => __('Email is required field'),
                'email.email'         => __('Email invalidate'),
                'password.required'   => __('Password is required field'),
                'first_name.required' => __('The first name is required field'),
                'last_name.required'  => __('The last name is required field'),
                'term.required'       => __('The terms and conditions field is required'),
            ];
            if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
                $codeCapcha = $request->input('g-recaptcha-response');
                if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                    $errors = new MessageBag(['message_error' => __('Please verify the captcha')]);
                    return response()->json([
                        'error'    => true,
                        'messages' => $errors
                    ], 200);
                }
            }
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'error'    => true,
                    'messages' => $validator->errors()
                ], 200);
            } else {

                $user = \App\User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name'  => $request->input('last_name'),
                    'email'      => $request->input('email'),
                    'password'   => Hash::make($request->input('password')),
                    'status'    => $request->input('publish','publish'),
                    'phone'    => $request->input('phone'),
                ]);
                $user->assignRole(1); // setting_item('user_role')
                event(new Registered($user));

                /*
                try {
                    event(new SendMailUserRegistered($user));
                } catch (Exception $exception) {
                    Log::warning("SendMailUserRegistered: " . $exception->getMessage());
                }
                Auth::loginUsingId($user->id);
                */
                Session::flash('success', 'Registration verification mail sent successfully');

                return response()->json([
                    'error'    => false,
                    'messages' => false,
                    'redirect' => $request->input('redirect') ?? $request->headers->get('referer') ?? url(app_get_locale(false, '/'))
                ], 200);
            }
        }

        public function verifyRegistration(Request $request)
        {
            $userId = $request->route('id');

            if ((int)$userId == 0) {
                throw new AuthorizationException;
            }

            $user = User::find($userId);

            if (!$user) {
                abort(404);
            }

            if ($request->route('hash') != sha1($user->email)) {
                abort(404);
            }

            if ($user->is_verified) {
                Session::flash('success', trans('User already verified'));
                return redirect()->route('login');
            }

            $user->markEmailAsVerified();
            $user->is_verified = 1;
            $user->active_status = 1;
            $user->need_update_pw = 0;
            $user->save();

            event(new Verified($request->user()));

            Session::flash('success', trans('User email is verified. You can now login through web portal'));

            return redirect()->route('login');
        }


        /**
         * Login
         *
         * @param Request $request
         * @return JsonResponse
         */
        public function login(Request $request)
        {
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'active_status' => 1
            ];

            if (Auth::attempt($credentials)) {
                //Auth::login($user);
                Session::flash('success', trans('Logged in successfully'));
                return response()->json(['message' => trans('Logged in successfully')]);
            }

            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'email' => [[trans('auth.failed')]]
                ]
            ], 401);
        }
    }
