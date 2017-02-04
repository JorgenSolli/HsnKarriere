  @unless ($studenter == null)
    @php $row = 0 @endphp
    <!-- Card sort -->
    <div class="row">
      @foreach ($studenter as $student)
        <div class="col-md-3">
          <div class="panel panel-default panel-profile">
            <div class="panel-heading" style="background-image: url(/uploads/{{ $student->forsidebilde }});">
            </div>
            <div class="panel-body text-center">
              <img class="panel-profile-img" src="/uploads/{{ $student->profilbilde }}" alt="Profilbilde">
              <p class="h5 panel-title">{{ $student->fornavn }} {{ $student->etternavn }}</p>
              <p>Studerer ved campus {{ $student->student_campus }}</p>
              <p class="m-b-md">
                <span class="fa fa-envelope-o"></span> {{ $student->email }}
                <br>
                <span class="fa fa-phone"></span> {{ $student->telefon }}
              </p>
              <a class="btn btn-primary-outline btn-sm" href="/bruker/{{ $student->user_id }}">
                <span class="icon icon-user"></span> Se profil
              </a>
            </div>
          </div>
        </div>
        @php $row++ @endphp
        @if ($row == 4)
          @php $row = 0 @endphp
          </div>
          <div class="row">
        @endif
        @endforeach
      </div>
  @else
    <p>Det finnes ingen studenter som passer til din bedrift</p>
  @endunless
