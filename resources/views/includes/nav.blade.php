<br><nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li id="product" class="nav-item {{ (Request::is('/')) ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/') }}">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link id="product" class="nav-item {{ (Request::is('/directory')) ? 'active' : '' }}" href="{{ url('directory') }}">Directory</a>
    </li>
    <li class="nav-item">
    <a class="nav-link id="product" class="nav-item {{ (Request::is('billing')) ? 'active' : '' }}" href="{{ url('billing') }}">Search</a>
    </li>
  </ul>
</nav>

@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
    @endif
    @if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
