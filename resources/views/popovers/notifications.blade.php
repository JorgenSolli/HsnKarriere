@for ($i = 0; $i < count($events); $i++)
  @if ($events[$i]['message_read'] == 0)
    <li class="unread">
      <a href="/innboks#msg{{ $events[$i]['message_id'] }}">
        <span class="fa fa-envelope"></span>
  @else
    <li>
      <a href="/innboks#msg{{ $events[$i]['message_id'] }}">
        <span class="fa fa-envelope-open-o"></span>
  @endif
      {{ $events[$i]['message']}}
    <br>
    <small>Fra {{ $events[$i]['user_name']}} · {{ $events[$i]['updated_at'] }}</small>
    </a>
  </li>
@endfor