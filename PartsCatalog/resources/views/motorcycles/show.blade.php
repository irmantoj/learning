@extends("layouts/layout")

@section("title")
  <h1 class="title">Motorcycle stunt parts catalog</h1>
  <h2 class="sub-title">Edit motorcycle model, make or year. Add or remove parts categories to related model.</h2>
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
      @can("update", $motorcycle)
      <a class="dropdown-item" href="/motorcycles/{{$motorcycle->id}}/category/create">Add new category</a>
      @endcan
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
      <h2 class="title is-4 is-pulled-left">{{ $motorcycle->make }} {{ $motorcycle->model }} {{ $motorcycle->year }}</h2>

      @can("update", $motorcycle)
      <form class="is-pulled-right" action="/motorcycles/{{ $motorcycle->id }}" method="post">
        {{ csrf_field() }}
        {{ method_field("DELETE") }}
        <button class="button is-danger" type="submit" name="button">Delete</button>
      </form>
      <a class="button is-success is-pulled-right mx-1" href="/motorcycles/{{ $motorcycle->id }}/edit">Edit</a>
      @endcan

      <div class="is-clearfix"></div>
      <h2 class="title is-4 field my-2 is-pulled-left">Parts categories related to selected model</h2>

      <div class="is-clearfix"></div>

      @foreach($categories as $category)
        <p class="is-pulled-left"><a href="/motorcycles/{{ $motorcycle->id }}/category/{{ $category->id }}/show" >{{ $category->title }}</a></p>


        @can("update" , $motorcycle)
        <form class="is-pulled-right" action="/motorcycles/{{ $motorcycle->id }}/category/{{ $category->id }}" method="post">
          {{ csrf_field() }}
          {{ method_field("DELETE") }}
          <button class="button is-small is-danger" type="submit" name="button">Delete</button>
        </form>
        <a class="button is-small is-success is-pulled-right mx-1" href="/motorcycles/{{$motorcycle->id}}/category/{{ $category->id }}/edit">Edit</a>
        @endcan

        <div class="is-clearfix"></div><hr>


      @endforeach
    </div>
  </div>
@endsection("content")
