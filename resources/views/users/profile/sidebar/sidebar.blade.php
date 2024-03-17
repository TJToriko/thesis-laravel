<div class="card">
    <div class="card-header">Welcome , {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }} {{ Auth::user()->suffix }}</div>
    <div class="card-body">
         <img class="card-img-top" src="https://thumbs.dreamstime.com/b/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg">
         <ul class="list-group list-group-flush">
            <a href="{{ route('profile.user')}}" class="text-muted"> <li class="list-group-item"><i class="fas fa-home"></i> Dashboard</li></a>
            <a href="{{ route('my.lot')}}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-file-alt"></i>  My Lots</li></a>
            
            <a href="" class="text-muted"> <li class="list-group-item"><i class="fas fa-edit"></i> Setting</li> </a>
            {{-- <a href="" class="text-muted"> <li class="list-group-item"><i class="fas fa-edit"></i> My Address</li> </a> --}}
            <a href="" class="text-muted"> <li class="list-group-item"> <i class="fab fa-telegram-plane"></i> Open Ticket</li> </a>
            <a href="{{ route('logout')}}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-sign-out-alt"></i> Logout</li> </a>
           </ul>
     
    </div>
</div>