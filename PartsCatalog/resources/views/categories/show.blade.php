@extends("layouts/layout")

@section("title")
  <h1 class="title">Motorcycle stunt parts catalog</h1>
  <h2 class="sub-title">View parts</h2>
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
        @can("update" , $motorcycle) <a class="dropdown-item" href="/motorcycles/{{ $motorcycle->id }}/category/{{ $category->id }}/part/create">Add new parts</a> @endcan
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
    <div class="column">
      <h2 class="title is-4 level-item" >Parts for {{ $motorcycle->make }} {{ $motorcycle->model }} {{ $motorcycle->year }} from {{ $category->title }} category</h2><br>
    </div>
  </div>

    <?php $count = 0; ?>
    @foreach($parts as $part)

    @if($count == 0 || $count % 3 == 0)
    <div class="columns">
    @endif


      <div class="column is-4">

        <div class="card">
      <div class="card-image">
        <figure class="image is-4by3">
          <img src="{{ $part->img }}" alt="Placeholder image">
        </figure>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p class="title is-4">{{ $part->title }}</p>
            <p class="subtitle is-6t">Brand: {{ $part->manufacturer}} <br>  Price: {{ $part->price}} $</p>
          </div>
        </div>

        <div class="content">
          {{ str_limit($part->description, 90, "...") }} <a href="/motorcycles/{{ $motorcycle->id }}/category/{{ $category->id }}/show/{{ $part->id }}/show">Show more...</a>
        </div>
      </div>
        </div>

      </div>
      @if($count == 2 || $count % 3 == 2)
      </div>
      @endif
      <?php $count++; ?>
    @endforeach


@endsection("content")
