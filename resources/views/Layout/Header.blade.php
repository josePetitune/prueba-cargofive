<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="{{route('Dashboard')}}"><img class="navbar-logo-rf" src="{{asset('storage/logo.svg')}}" width="100%" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('Dashboard')}}">REGISTRO DE RUTAS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('Documentation')}}">DOCUMENTACION</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://github.com/josePetitune/prueba-cargofive" data-toggle="tooltip" data-placement="top" title="Instagram">
            <span class="ion-logo-github"></span> Git-Hub
          </a>
        </li>
      </ul>
    </div>
  </nav>