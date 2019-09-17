<div class="form-group row">
    <label for="{{ $filter->key() }}" class="col-sm-2 col-form-label">{{ $filter->name() }}</label>
    <div class="col-sm-10">
        <select id="{{ $filter->key() }}" name="{{ $filter->key() }}" class="form-control">
            <option value="">&ndash;</option>
            @foreach($filter->options(request()) as $key => $value)
                <option value="{{ $key }}" {{ request()->input($filter->key()) === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        @if ($filter->description())
            <small class="form-text text-muted">{{ $filter->description() }}</small>
        @endif
    </div>
</div>