<div class="row" id="blockLanguage">
    <div class="col-sm-8 col-md-9 col-lg-10"></div>
    <div class="col-sm-4 col-md-3 col-lg-2">
            <select class="form-control select2" id="changeLanguage">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                        <option data-href="{{ LaravelLocalization::getLocalizedURL($properties['regional'], null, [], true) }}" value="{{ $properties['regional'] }}" selected>{{$properties['native']}}</option>
                    @else
                        <option data-href="{{ LaravelLocalization::getLocalizedURL($properties['regional'], null, [], true) }}"  value="{{ $properties['regional'] }}">{{$properties['native']}}</option>
                    @endif
                @endforeach
            </select>
    </div>
</div>