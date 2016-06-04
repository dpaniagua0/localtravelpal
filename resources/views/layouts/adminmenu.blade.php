<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
    Users <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" role="menu">
    <li>
      <a href="{{ route('users.index') }}">
        <i class="fa fa-btn fa-eye" aria-hidden="true"></i>
        View Users
      </a>
      <a href="{{ route('users.create') }}">
        <i class="fa fa-btn fa-plus" aria-hidden="true"></i>
        Add User
      </a>
    </li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
    Roles <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" role="menu">
    <li>
      <a href="{{ route('roles.index') }}">
        <i class="fa fa-btn fa-eye" aria-hidden="true"></i>
        View Roles
      </a>
      <a href="{{ route('roles.create') }}">
        <i class="fa fa-btn fa-plus" aria-hidden="true"></i>
        Add Role
      </a>
    </li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
    Categories <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" role="menu">
    <li>
      <a href="{{ route('categories.index') }}">
        <i class="fa fa-btn fa-eye" aria-hidden="true"></i>
        View categories
      </a>
      <a href="{{ route('categories.create') }}">
        <i class="fa fa-btn fa-plus" aria-hidden="true"></i>
        Add User
      </a>
    </li>
  </ul>
</li>