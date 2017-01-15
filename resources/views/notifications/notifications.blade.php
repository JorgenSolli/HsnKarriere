@if (session('success'))
  <div class="growl">
    <div class="alert alert-success alert-dismissable" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      {{ session('success') }}
    </div>
  </div>
@endif

@if (session('danger'))
  <div class="growl">
    <div class="alert alert-danger alert-dismissable" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      {{ session('danger') }}
    </div>
  </div>
@endif