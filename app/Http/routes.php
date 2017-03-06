<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
date_default_timezone_set ("America/Mexico_City");

Route::get('/', function()
{
	return View::make('index');
});

Route::post('/practice', function() {

    echo 'Hello World!';
    echo App::environment();
});

Route::get('/nosotros', function()
{
	return View::make('nosotros');
});

Route::get('/hacemos', function()
{
	return View::make('hacemos');
});

Route::get('/galeria', function()
{
	return View::make('galeria');
});

Route::get('/experiencias', function()
{
	return View::make('experiencias');
});

Route::get('/contacto', function()
{
	return View::make('contacto');
});

Route::post('/contacto',
	array(
	function(){
		$name= Input::get('client');
		$email= Input::get('email');
		$phone= Input::get('phone');
		$message=Input::get('message');
		
		$user= array(
			'email'=>$email,
			'name'=>$name,
		);

		$data = array(
			'email'=>$email,
			'name'=>$name,
			'phone'=>$phone,
			'detail'=>$message
		);

		Mail::send('mailcontacto', $data, function($message) use($data)
		{
			$message->to('anapolavarrieta@gmail.com', 'Ana Paula')
					->subject('Nueva informaci??n de contacto');
		});

		return View::make('gracias');
	})
);

Route::get('/signup', ['middleware' => 'guest', 'uses' => 'UsersController@signup']);

Route::post('/signup',
	array(
		'before'=>'csrf',
		function(){
			$rules =array(
				'email'=> 'required|email|unique:users,email',
				'password' => 'required|min:5',
				'name'=> 'min:3',
				'last_name'=> 'min:3',
				'university_id' => 'integer'
			);

			$validator= Validator::make(Input::all(), $rules);
			if($validator->fails()){
				return Redirect::to('/signup')
								->with('flash_message', 'No se pudo crear la cuenta. Favor de corregir los siguientes errores')
								->withInput()
								->withErrors($validator);
			}

			$user=new App\User;
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->name= Input::get('name');
			$user->last_name= Input::get('last_name');
			$user->phone= Input::get('phone');
			$user->university= Input::get('university');
			$user->university_id= Input::get('university_id');
			$user->major= Input::get('major');
			$user->semester= Input::get('semester');

			try{
				$user->save();
			}
			catch (Exception $e){
				return Redirect::to('/signup')
					->with('flash_message','No se puedo crear la cuenta, intenta de nuevo')
					->withInput();
			}

			Auth::login($user);

			return Redirect::to('/user_home')
					->with('flash_message','Bienvenido');
		}
	)
);

Route::get('/login', ['middleware' => 'guest', 'uses' => 'UsersController@login']);

Route::post('/login',
	array(
		'before'=>'csrf',
		function(){
			$credentials= Input::only('email', 'password');

			if(Auth::attempt($credentials, $remember=true)) {
				$user= App\User::find(Auth::id());
				if($user->admin !=1){
					return Redirect::intended('/user_home')
							-> with('flash_message', 'Bienvenido!');
				}
				else{
					return Redirect::to('/admin')
							->with('flash_message', 'Bienvenido');
				}
			}
			else{
				return Redirect::to('/login')
						->with('flash_message','No se ha podido conectar, por favor intente nuevamente');
			}
			return Redirect::to('user_home');
		}
	)
);

Route::get('/logout', function()
{
	Auth::logout();
	return Redirect::to('/');
});
	
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
/*
Route::get('password/reset', array(
  'uses' => 'RemindersController@getRemind',
  'as' => 'passwordremind'
));

Route::post('password/reset', array(
  'uses' => 'RemindersController@postRemind',
  'as' => 'passwordrequest'
));

Route::get('password/reset/{token}', array(
  'uses' => 'RemindersController@getReset',
  'as' => 'password.reset'
));

Route::post('password/reset/{token}', array(
  'uses' => 'RemindersController@postReset',
  'as' => 'password.update'
));*/

Route::get('/user_home', ['middleware' => 'auth', 'uses' => 'UsersController@home']);


Route::post('/entry',function()
{
	$user= App\User::find(Auth::id());
	$register=new App\Register();
	$register->lat=Input::get('latitude');
	$register->lon= Input::get('longitude');
	$flag= "Se ha registrado tu entrada";
	$x= $register->lat - 19.287564;
	$y= $register->lon + 99.159166;
	if( ($x*$x) + ($y*$y) <= (0.008970525 * 0.008970525)){
		$register->type='entry';
	}
	elseif($register->lat == 0 && $register->lon == 0){
		
		$register->type='error en direccion';
	}
	else{
		$register->type='other_entry';
	}
	if($register->lat == 0 && $register->lon ==0){
		$flag= "Es necesario habilitar la opcion Share location";
	}
	$register->date= date("Y-m-d");
	$register->time= date("G:i:s");
	$register->user()->associate($user);
	$register->save(); 
 	return View::make('entry')->with ('flag', $flag);
});

Route::post('/exit',function()
{
	$user= App\User::find(Auth::id());
	$register=new App\	Register();
	$register->lat=Input::get('latitude2');
	$register->lon=Input::get('longitude2');
	$flag= "Se ha registrado tu salida";
	$x= $register->lat - 19.287564;
	$y= $register->lon + 99.159166;
	if( ($x*$x) + ($y*$y) <= (0.008970525 * 0.008970525)){
		$register->type='entry';
	}
	elseif($register->lat == 0 && $register->lon == 0){
		$register->type='error en direccion';
		$flag= "Para poder registrar tu salida es necesario habilitar la opci??n Share Location";
	}
	else{
		$register->type='other_exit';
	}
	$register->date= date("Y-m-d");
	$register->time= date("G:i:s");
	$register->user()->associate($user);
	$register->save(); 
 	return View::make('exit')->with ('flag', $flag);
});

Route::get('/proyecto', function()
{
	return View::make('underconstruction');
});

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'UsersController@admin']);

Route::get('/users_hours', ['middleware' => 'admin', 'uses' => 'UsersController@users_hours']);

Route::get('/userhours/{id}', ['middleware' => 'admin', 'uses' => 'UsersController@userhoursid']);

Route::get('/edit_user/{id}', ['middleware'=> 'auth', 'as'=>'user.update', 'uses'=> 'UsersController@edit_user']);

Route::get('/reportes', ['middleware'=> 'admin', 'uses'=> 'UsersController@reportes']);

Route::post('/reportes',['middleware' => 'admin', 'uses' => 'UsersController@userhoursid']);

Route::post('/excel',['middleware' => 'admin', 'uses' => 'UsersController@excel']);
	

Route::get('/editar_usuario',['middleware' => 'admin', 'uses' => 'UsersController@editar_usuario']);
	
Route::post('/edit_user/{id}',
	array(
		'before'=>'csrf',
		function($id){
			$user=App\User::findorFail($id);
			$user->fill(Input::all());
			$user->save();
			return Redirect::to('/admin')
							->with('flash_message','Los cambios se han guardado');
		}
	)
);

Route::get('/delete_user/{id}', ['middleware' => 'admin', 'uses' => 'UsersController@delete_user']);


Route::get('/paginas', function()
{
	return View::make('paginas');
});




Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});
