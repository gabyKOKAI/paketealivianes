<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;



use Illuminate\Http\Request;

class UsersController extends Controller {

	public function home()
	{
		return View('user_home');
	}

	public function signup()
	{
		return View('signup');
	}

	public function login()
	{
		return View('login');
	}

	public function admin()
	{
		$users= \App\User::all();
		return View('admin')->with('users',$users);
	}

	public function users_hours()
	{
		$users= \App\User::all();
		return View('users_hours')->with('users',$users);
	}
	

	public function userhoursid()
	{
		$date1= \Input::get('date1');
		$daet2= \Input::get('date2');
		$id= \Input::get('usuario');
		$users= \App\User::all();

		if ($id == "all"){
			return View('alluserhours')
				->with ('users', $users)
				->with ('id', $id);
		}
		else{
		$user= \App\User::findOrFail($id);
		$first_reg= $user->register()->first();			
		if($first_reg){
				$date1= $first_reg->date;
				$hour1= $first_reg->time;
				return View('userhours')
						->with('user', $user)
						->with('date1', $date1)
						->with ('hour1', $hour1)
						->with ('lat', $first_reg->lat)
						->with ('id', $id);
			}
		return Redirect('/reportes')->with('flash_message','El usuario no tiene registros');
		}
		
	}

	public function edit_user($id)
	{
		$user=\App\User::findOrFail($id);
		try{
			return View('edit_user')
					->with('user', $user);
		}
		catch (Exception $e){
				return Redirect('users_hours');
			}
	}

	public function editar_usuario()
	{
		$user=\App\User::find(3);
		$user->admin='1';
		$user->save();

	return 'Se edito';
	}
	public function delete_user($id)
	{
			$user= App\User::findOrFail($id);
			foreach($user->register as $register){
				$register->delete();
			}
			$user->delete();
			return Redirect::to('/admin')
						->with('flash_message','El usuario se ha eliminado');
	}

	public function reportes()
	{
		$users= \App\User::all();
		$users= \App\User::select ('id', \DB::raw('CONCAT(name, " ", last_name) AS full_name'))
						-> orderBy ('name')
						-> lists ('full_name', 'id');
		
		return View('reportes')->with('users',$users);
	}

	public function excel()
	{
   		 $excel= \Excel::create('Reporte', function ($excel){
   		 	$excel->sheet('Reporte', function ($sheet){

   		 		$id = \Input::get('id');
   		 		if ($id == 'all'){
   		 			$users= \App\User::all();
   		 			$sheet->loadView('excelallusers')
   		 		      	  ->with ('users', $users);
   		 		}
   		 		else{
   		 		$user= \App\User::findOrFail($id);
   		 		$date1 = \Input::get('date1'); 
   		 		$hour1 = \Input::get('hour1'); 
   		 		$lat = \Input::get('lat'); 
   		 		$sheet->loadView('exceluser')
   		 		      ->with ('user', $user)
   		 		      ->with ('date1', $date1)
   		 		      ->with ('hour1', $hour1)
   		 		      ->with ('lat',$lat);
   		 		}
   		 		});
   		 	

   		});
       
    	 return  $excel->export('xls'); 
	}
	

}
