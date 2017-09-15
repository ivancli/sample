@if($alerts && !empty($alerts->getBags()))
    <div
            @if($alerts->hasBag('success'))
                class="alert alert-success {{isset($class) ? $class : ''}}"
            @elseif($alerts->hasBag('errors'))
                class="alert alert-danger {{isset($class) ? $class : ''}}"
            @elseif($alerts->hasBag('default'))
                class="alert alert-danger {{isset($class) ? $class : ''}}"
            @endif
    >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <ul class="list-unstyled text-center">

            @foreach ($alerts->getBags() as $alert)
                <li>{{ $alert->first() }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success text-center {{isset($class) ? $class : ''}}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ session()->get('success')->first() }}
    </div>
@endif