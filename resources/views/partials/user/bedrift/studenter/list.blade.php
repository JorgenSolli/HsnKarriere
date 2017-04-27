@if ($studenter)
  <div class="row">
    @foreach ($studenter as $chunk)
      <div class="col">
        <ul class="media-list media-list-users list-group col-md-6">
          @foreach ($chunk as $student)
            <li class="list-group-item">
              <div class="media">
                <a class="media-left" href="/bruker/{{ $student->user_id }}">
                  <img class="media-object img-circle" src="/uploads/{{ $student->profilbilde }}" alt="Profilbilde">
                </a>
                <div class="media-body">
                  <a href="/bruker/{{ $student->user_id }}" class="btn btn-primary-outline btn-sm pull-right">
                    <span class="icon icon-user"></span> Se profil
                  </a>
                  <strong>{{ $student->fornavn }} {{ $student->etternavn }}</strong>
                  <small>@ {{ $student->email }}</small>
                  <br>
                  <p>Studerer {{ $student->study }} ved campus {{ $student->campus }}</p>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
@else
  <p>Det finnes ingen studenter som passer til din bedrift</p>
@endif