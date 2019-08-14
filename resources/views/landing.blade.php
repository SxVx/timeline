@extends('layout')

@section('title')
	Linea de tiempo
@endsection

@section('brand-text')
	<b>Linea de tiempo</b>
@endsection

@section('navbarOptions')
	<li class="nav-item">
		<a class="nav-link text-white" href="/"><i class="fa fa-home mr-1"></i>Casa</a>
	</li>
	<li class="nav-item">
		<a class="nav-link text-white" data-toggle="modal" data-target="#modalAccess"><i class="fa fa-sign-in mr-1"></i>Acceder</a>
	</li>
@endsection

@section('content')
<div class="container">



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


@section('form')
	<!-- Modal -->
	<div class="modal fade" id="modalAccess" tabindex="-1" role="dialog" aria-labelledby="modalAccess" aria-hidden="true">
		<div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<img src="{{ asset('img/default.png') }}" class="rounded-circle img-responsive white" alt="Avatar photo">
				</div>
				<div class="modal-body border-rounded my-1 p-4">

					<h5 class="mt-1 mb-2 text-uppercase text-center">Iniciar Sesi&oacute;n</h5>
					<form action="/log" method="post">
						
						{{ csrf_field() }}

						<div class="md-form">
							<i class="fa fa-lg prefix fa-user"></i>
							<input id="user" name="user" placeholder="Usuario" class="form-control" type="text" required>
						</div>

						<div class="md-form">
							<i class="fa fa-lg prefix fa-key"></i>
							<input id="password" name="password" placeholder="Contraseña" class="form-control" type="password" required>
						</div>
						<div class="text-center mt-4">
							<button class="btn btn-primary waves-effect waves-light" type="submit">Entrar<i class="fa fa-sign-in ml-1"></i>
						</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
@endsection