@for ($i = 0; $i < count($messages); $i++)
  @if ($messages[$i]['message_read'] == 0)
    <li class="unread">
      <a href="/innboks#msg{{ $messages[$i]['message_id'] }}">
        <span class="fa fa-envelope"></span>
  @else
    <li>
      <a href="/innboks#msg{{ $messages[$i]['message_id'] }}">
        <span class="fa fa-envelope-open-o"></span>
  @endif
      {{ $messages[$i]['message']}}
    <br>
    <small>Fra {{ $messages[$i]['user_name']}} · {{ $messages[$i]['updated_at'] }}</small>
    </a>
  </li>
@endfor

@foreach ($notifications as $notification)
  @if ($notification->has_seen == null)
    <li class="unread">
  @else
    <li>
  @endif
    <a href="/oversikt">
      <span class="fa fa-handshake-o"></span>
      {{ $notification->heading }}
      <br>
      <small>{{ $notification->message }}</small>
    </a>
  </li>
@endforeach