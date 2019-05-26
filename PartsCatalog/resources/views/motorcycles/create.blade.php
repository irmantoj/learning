@extends("layouts/layout")

@section("title")
  <h1 class="title">Motorcycle stunt parts catalog</h1>
  <h2 class="sub-title">Add motorcycle model</h2>
@endsection

@section("top-button")
  <div id="menu" class="dropdown">
  <div class="dropdown-trigger">
    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
      <span>Menu</span>
      <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
    </button>
  </div>
  <div class="dropdown-menu" id="dropdown-menu" role="menu">
    <div class="dropdown-content">
      <a class="dropdown-item" href="/motorcycles">To motorcycles catalog</a>
      <a class="dropdown-item" href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
  </div>
</div>
@endsection

@section("content")
  <div class="columns is-centered">
    <div class="column is-half">
      <h2 class="title is-4">Add new motorcycle to catalog</h2>
      <form class="" action="/motorcycles" method="post">
        {{ csrf_field() }}
        <label class="label" for="make">Make:</label>
        <input class="input field {{ $errors->has('make') ? 'is-danger' : ''}}" type="text" name="make" value="{{Request::old('make')}}">
        <label class="label" for="model">Model:</label>
        <input class="input field {{ $errors->has('model') ? 'is-danger' : ''}}" type="text" name="model" value="{{Request::old('model')}}">
        <label class="label" for="year">Years:</label>
        <input class="input field {{ $errors->has('year') ? 'is-danger' : ''}}" type="text" name="year" value="{{Request::old('year')}}">
        <button class="button is-success" type="submit">Add</button>
      </form>
    </div>
  </div>
  @if($errors->any())
  <div class="columns is-centered">
    <div class="column is-half">
      <div class="notification is-danger">
      @foreach($errors->all() as $error)
        <p class="">{{ $error }}</p>
      @endforeach
      </div>
    </div>
  </div>
  @endif
@endsection("content")
