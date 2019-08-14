@extends('layout')

@section('title')
	Linea de tiempo
@endsection

@section('brand-text')
    <b>Bienvenido : {{ session('sesion')['user'] }} </b>
@endsection

@section('navbarOptions')
	<li class="nav-item">
		<a class="nav-link text-white" href="/"><i class="fa fa-home mr-1"></i>Casa</a>
	</li>
	<li class="nav-item">
		<a class="nav-link text-white" href="/logout"><i class="fa fa-sign-in mr-1"></i> Cerrar sesión </a>
	</li>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <h5 class="card-header red darken-2 white-text text-center py-4">
                        <strong>Subir una publicaci&oacute;n</strong>
                    </h5>
                    <div class="card-body px-lg-5">
                        <form action="/postear" method="POST" style="color: #757575;">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="content" id="content" class="rounded-0 form-control" cols="30" rows="5" style="resize:none;" placeholder="&iquest;En qu&eacute; est&aacute;s pensando?" required></textarea>
                            </div>
                            <button class="btn red darken-2 rounded d-block text-white mr-auto ml-auto z-depth-0 my-3 waves-effect" type="submit">Publicar <i class="fa fa-send"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
        {{-- PAGINADO --}}
        <nav class="my-4">
            <ul class="pagination pg-red justify-content-center" style="overflow:hidden">
                @if($page==0)
                    <li class="page-item active"><a href="/" class="page-link">Inicio</a></li>
                @else
                    @if( $page/10 >= 1)
                        <li class="page-item">
                            <a class="page-link waves-effect waves-effect" href="/{{ $page-10 }}" aria-label="Previous">
                                <span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span>
                                <span class="sr-only">Backward 10</span>
                            </a>
                        </li>
                    @endif
                    <li class="page-item">
                        <a class="page-link waves-effect waves-effect" href="/{{ $page-1 }}" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                        <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                @for ($i = $page; $i < $page+10 ; $i++)

                    @if($i>=$numPages)
                        @break
                    @endif

                    @if($i>0)	
                        @if($page==$i)
                            <li class="page-item active">
                        @else
                            <li class="page-item">
                        @endif
                            <a href="{{ $i }}" class="page-link">
                                {{ $i }}
                            </a>
                        </li>
                    @endif	
                @endfor

                @if($numPages>$page)
                    <li class="page-item">
                        <a class="page-link"  href="{{ $page+1 }}" aria-label="Next">
                            <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @endif
                @if($numPages>$page+10)
                    <li class="page-item">
                        <a class="page-link"  href="{{ $page+10 }}" aria-label="Next">
                            <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span>
                            <span class="sr-only">Forward 10</span>
                        </a>
                    </li>
                @endif

            </ul>


        </nav>
        {{-- PAGINADO --}}
    </div>


    <div role="main">
        <!-- Start Schedule  -->
        <section id="mu-schedule">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <!--List of items -->
                        <div class="mu-schedule-area">
                            <div class="mu-schedule-content-area">
                                <div class="tab-content mu-schedule-content">
                                    <div role="tabpanel" class="tab-pane mu-event-timeline in active" id="first-day">
                                        @php
                                            $band=true
                                        @endphp


                                        <ul>
                                            @forelse ( $posts as $post)
                                                <li>
                                                    <div class="mu-single-event">
                                                        <h4 class="font-weight-bold"> 
                                                                {{ $post->USR_Nombre }} 
                                                        </h4>
                                                        <blockquote class="blockquote py-2">
                                                            <p class="my-1">
                                                                {{ $post->PTS_Contenido }}
                                                            </p>
                                                            <p class="text-muted my-1">
                                                                <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                                {{ date_format($post->created_at,"Y-m-d") }} 
                                                            </p>
                                                        </blockquote>
                                                    </div>

                                                    @foreach($comentarios as $comentario)
                                                        @if($comentario->PTS_ID==$post->PTS_ID)
                                                            <div class="list-group-item mu-single-event">
                                                                <h6 class="h6-responsive font-weight-bold"> {{ $comentario->USR_Nombre }}</h6>
                                                                <blockquote>
                                                                    <p class="text-muted my-1">
                                                                        {{ $comentario->CMT_Contenido }}
                                                                    </p>
                                                                    <small class="text-muted my-1 w-100">
                                                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                                        {{ date_format($comentario->created_at,"Y-m-d") }} 
                                                                    </small>
                                                                </blockquote>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <div class="mu-single-event" style="margin:0;padding:0;">
                                                        <div class="red darken-2 w-100 h-100">
                                                            <form action="/comentar" class="mx-2 mt-1 py-1" method="POST">
                                                                {{ csrf_field() }}
                                                                <textarea name="content" id="content" class="rounded-0 form-control" cols="40" rows="2" style="resize:none;" placeholder="&iquest;En qu&eacute; est&aacute;s pensando?" required></textarea>
                                                                <input type="hidden" name="idpost" value="{{ $post->PTS_ID }}">
                                                                <button class="btn btn-black btn-rounded waves-light btn-md d-block mr-auto ml-auto z-depth-0 my-2 waves-effect text-white" type="submit">Comentar <i class="fa fa-comment ml-1"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </li>
                                            @empty
                                                <li>
                                                    <div class="mu-single-event">
                                                        <h4 class="font-weight-bold"> 
                                                            No hay comentarios
                                                        </h4>
                                                        <blockquote class="blockquote py-2">
                                                            <p class="my-1">
                                                                vuelva más tarde porfavor
                                                            </p>
                                                            <p class="text-muted my-1"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date("Y-m-d") }} </p>
                                                        </blockquote>
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>


                                    </div>

                                </div>

                            </div>
                            
                        </div>
                        <!--END List of items -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Schedule -->		
    </div>

	
	
@endsection