<!--  Header Start -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg  ">
         <div class="container-fluid">
             <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                 <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                     <li class="nav-item dropdown">
                         <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2rem">
                            {{ Auth::user()->name }}
                         </a>
                         <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                             <div class="message-body">
                                 <a href="{{route('profile')}}" class="d-flex align-items-center gap-2 dropdown-item">
                                     <i class="ti ti-user fs-6"></i>
                                     <p class="mb-0 fs-3">My Profile</p>
                                 </a>
                                 <a class="btn btn-outline-primary mx-3 mt-2 d-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">Logout</a>
                             </div>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>

     <form id="logout-form" action="{{route('logout')}}" method="post">
         @csrf
     </form>
 </header>
 <!--  Header End -->
