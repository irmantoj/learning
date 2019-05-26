@extends("layouts/layout")

@section("title")
  <h1 class="title">Motorcycle stunt parts catalog</h1>
  <h2 class="sub-title">Edit motorcycle parts category title</h2>
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
      <a class="dropdown-item" href="/motorcycles/{{ $motorcycle->id }}">To related motorcycle categories</a>
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
      <form class="" action="/motorcycles/{{ $motorcycle->id }}/category/{{ $category->id }}" method="post">
        {{ csrf_field() }}
        {{ method_field("PATCH") }}
        <label class="label" for="title">Title:</label>
        <input class="input field {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title" value="{{ $category->title }}">
        <button class="button is-success" type="submit">Update</button>
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
