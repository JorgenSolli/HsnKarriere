<div id="sortListContainer">
  @unless ($studenter == null)
    <!-- List sort -->
    @foreach ($studenter as $student)
      <ul class="media-list media-list-users list-group col-md-6">
        <li class="list-group-item">
          <div class="media">
            <a class="media-left" href="/bruker/{{ $student->id }}">
              <img class="media-object img-circle" src="/uploads/{{ $student->profilbilde }}" alt="Profilbilde">
            </a>
            <div class="media-body">
              <a href="/bruker/{{ $student->id }}" class="btn btn-primary-outline btn-sm pull-right">
                <span class="icon icon-add-user"></span> Se profil
              </a>
              <strong>{{ $student->fornavn }} {{ $student->etternavn }}</strong>
              <small>@ {{ $student->email }}</small>
              <br>
              <p>Studerer ved campus {{ $student->student_campus }}</p>
            </div>
          </div>
        </li>
      </ul>
    @endforeach
  @else
    <p>Det finnes ingen studenter som passer til din bedrift</p>
  @endunless
</div>