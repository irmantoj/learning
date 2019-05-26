@extends("layouts/layout")

@section("title")
  <h1 class="title">Motorcycle stunt parts catalog</h1>
  <h2 class="sub-title">Choose motorcycle model</h2>
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
      @can("update" , $motorcycles->last())<a class="dropdown-item" href="/motorcycles/create">Add new motorcycle</a>@endcan
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
      <h2 class="title is-4 level-item">Stunt parts for following motorcycles</h2>
      <table class="table is-fullwidth is-hoverable">
        <tr>
          <th>Id</th>
          <th>Make</th>
          <th>Model</th>
          <th>Years</th>
        </tr>
        @foreach($motorcycles as $motorcycle)
          <tr>
            <td>{{ $motorcycle->id }}</td>
            <td><a href="/motorcycles/{{  $motorcycle->id }}">{{ $motorcycle->make }}</a></td>
            <td><a href="/motorcycles/{{  $motorcycle->id }}">{{ $motorcycle->model }}</a></td>
            <td>{{ $motorcycle->year }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection("content")
