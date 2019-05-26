@extends("layouts/layout")

@section("title")
  <h1 class="title">Motorcycle stunt parts catalog</h1>
  <h2 class="sub-title">View part</h2>
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
      <a class="dropdown-item" href="/motorcycles/{{ $motorcycle->id }}/category/{{ $category->id }}/show">To parts related to category</a>
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
  <div class="columns">
    <div class="column is-4">
      <figure class="image is-4by3">
        <img src="{{$part->img}}" alt="">
      </figure>

      @can("update", $motorcycle)
      <a class="button is-success my-2 is-pulled-left" href="/motorcycles/{{$motorcycle->id}}/category/{{$category->id}}/show/{{$part->id}}/edit">Edit</a>
      <form class="" action="/motorcycles/{{$motorcycle->id}}/category/{{$category->id}}/show/{{$part->id}}" method="post">
        {{ csrf_field() }}
        {{ method_field("DELETE") }}
        <button class="button is-danger my-2 mx-1 is-pulled-left" type="submit" name="button">Delete</button>
      </form>
      @endcan

    </div>

    <div class="column is-8">
      <h2 class="title">{{$part->title}}</h2>
      <p class="sub-title is-1">Price: {{$part->price}} $; <br />
        Brand: {{$part->manufacturer}}; <br />
        {{ $part->material ?  "Material: $part->material" : '' }} @if($part->material) <br /> @endif
        {{ $part->weight ?  "Material: $part->weight;" : '' }} </p>
      <p class="my-2">{{$part->description}}</p>
    </div>
  </div>
@endsection("content")
