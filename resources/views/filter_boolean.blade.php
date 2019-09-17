<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ $filter->name() }}</label>
    <div class=col-sm-10">
        @foreach($filter->options(request()) as $key => $value)
            <div class="custom-control custom-checkbox">
                <input id="{{ $filter->key() }}_{{ $key }}" name="{{ $filter->key() }}[{{$key}}]" type="checkbox" class="custom-control-input" {{ isset((request()->input($filter->key()))[$key]) ? 'checked' : '' }}>
                <label for="{{ $filter->key() }}_{{ $key }}" class="custom-control-label">{{ $value }}</label>
            </div>
        @endforeach
    </div>
</div>