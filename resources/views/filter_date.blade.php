<div class="form-group row">
    <label for="{{ $filter->key() }}" class="col-sm-2 col-form-label">{{ $filter->name() }}</label>
    <div class="col-sm-10">
        <input id="{{ $filter->key() }}" name="{{ $filter->key() }}" class="form-control" type="date" value="{{ request()->input($filter->key()) }}">
        @if ($filter->description())
            <small class="form-text text-muted">{{ $filter->description() }}</small>
        @endif
    </div>
</div>