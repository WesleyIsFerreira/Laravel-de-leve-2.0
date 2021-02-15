<nav class="navbar navbar-dark bg-dark navbar navbar-expand-lg ">
  <div class="col-11">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li @if($current == "home") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li @if($current == "categorias") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" aria-current="page" href="{{ route('categorias') }}">Categorias</a>
          </li>
          <li @if($current == "produtos") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" aria-current="page" href="{{ route('produtos') }}">Produtos</a>
          </li>
          <li @if($current == "categorias2") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" aria-current="page" href="{{ route('categorias2') }}">Categorias2</a>
          </li>
          <li @if($current == "fotos") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" aria-current="page" href="{{ route('fotos') }}">Album de fotos</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-1">
    <a href="/logout" class="link-light">Sair</a>
  </div>
</nav>