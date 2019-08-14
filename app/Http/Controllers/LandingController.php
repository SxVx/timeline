<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Usuario;
use App\Post;
use App\Comentario;


class LandingController extends Controller
{
    public function index($page=0){
    	//Calculamos el numero de paginas
    	$numPages = ceil( Post::All()->count() /10 );
    	//Tomamos 10 post segun la pagina
    	$posts = Post::leftJoin('usuarios','posts.USR_ID' , '=', 'usuarios.USR_ID')
				->select('posts.*','usuarios.USR_Nombre')
				->skip($page*10)->take(10)->orderBy('created_at','desc')->get();
    	//Validadmos que vista se muestra
    	if ( \Session::has('sesion') ){

    		$comentarios = Comentario:: leftJoin('usuarios','comentarios.USR_ID' , '=', 'usuarios.USR_ID')
						->select('comentarios.*','usuarios.USR_Nombre')
						->get();

    		return view('cuenta')
    					->with('comentarios',$comentarios)
    					->with('posts',$posts)
    					->with('numPages',$numPages)
						->with('page',$page);
    	}else{
    		
    		return view('landing')
    					->with('posts',$posts)
						->with('numPages',$numPages)
						->with('page',$page); 
    	}
    }

	
    public function log(Request $request){

    	if ($request->isMethod('post')) {
 			$user = $request->input('user');
			$pass = $request->input('password');
			$result = Usuario::where('USR_Nombre', $user)
							->where('USR_Contrasena', $pass)
							->get();
			
			if($result->count()>0){
				$id = $result[0]->USR_ID;	
				//Inicio de sesion
				\Session::put('sesion',['user' =>$user,'USR_ID'=>$id]);
				$mensaje = 'Autenficacion exitosa';
				\Session::flash('mensaje',$mensaje);
			}else{
				//Mandar mensaje autenficacion no exitosa
				$mensaje = 'Autenficacion no exitosa';
				\Session::flash('mensaje',$mensaje);
				return redirect('/');
				
			}

		}
		
		//Entro por metodo get
		return redirect('/');	
			
    }

    public function postear(Request $request){
    	if ($request->isMethod('post')) {
			$post = new Post;
			$post->PTS_Contenido = $request->input('content');
			$post->USR_ID = \Session::get('sesion')['USR_ID'];
			$post->save();
    	}
    	//Mostrar mensaje de posteo exitoso
    	$mensaje = 'Posteo añadido';
		\Session::flash('mensaje',$mensaje);
    	return redirect('/');
    }

    public function comentar(Request $request){
    	if($request->isMethod('post')){
	    	$comentario = new comentario;
	    	$comentario->CMT_Contenido = $request->input('content');
			$comentario->PTS_ID =  $request->input('idpost');
			$comentario->USR_ID	= \Session::get('sesion')['USR_ID'];
			$comentario->save();
		}

		//Mostar mensaje de comentario exitoso
		$mensaje = 'Comentario añadido';
		\Session::flash('mensaje',$mensaje);
		return redirect('/');
    }


    public function logout(){
    	\Session::forget('sesion');
    	return redirect('/');
    }
}