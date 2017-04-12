 <div id="sortListContainer">
  @if ($bedrifter)
    <!-- List sort -->
    @foreach ($bedrifter as $bedrift)
      <ul class="media-list media-list-users list-group col-md-6">
        <li class="list-group-item">
          <div class="media">
            <a class="media-left" href="/bruker/{{ $bedrift->user_id }}">
              <img class="media-object img-circle" src="/uploads/{{ $bedrift->profilbilde }}" alt="Profilbilde">
            </a>
            <div class="media-body">
              <a href="/bruker/{{ $bedrift->user_id }}" class="btn btn-primary-outline btn-sm pull-right">
                <span class="icon icon-user"></span> Se profil
              </a>
              <strong>{{ $bedrift->bedrift_navn }}</strong>
              <small>@ {{ $bedrift->email }}</small>
              <br>
              <p>Holder til i {{ $bedrift->poststed }}</p>
            </div>
          </div>
        </li>
      </ul>
    @endforeach
  @else
    <p>Det finnes ingen bedrifter som passer til din bedrift</p>
  @endif
</div>