@extends('admin.dashboard._content')
@include('admin._alert')
@section('form')
    @if (is_null(Session::get('input.id')))
        {{-- Store --}}
        <form action="{{ route('admin.dashboard.category.store') }}" class='form-horizontal' method='post'>
    @else
        {{-- Update --}}
        <form action="{{ route('admin.dashboard.category.update', Session::get('input.id')) }}" class='form-horizontal' method='post'>
    @endif
         @yield('error')
        @yield('warning')
        @yield('success')
        @yield('info')
        <fieldset>
            <div class='control-group'>
                <label class='control-label' for='title'>Categorie</label>
                <div class='controls'>
                    <input class='span6' id='title' name='category' placeholder=
                    'eg. News, Event, Story' type='text' value="{{ Session::get('input.category') }}" autofocus required>
                </div><!-- /controls -->
            </div><!-- /control-group -->

            <div class='control-group'>
                <label class='control-label' for='title'>Taal</label>

                <div class='controls'>
                    <select name="language_id" required>
                    @foreach (Language::where('deleted_at', '=', null)->get()->toArray() as $language)
                        <option value="{{ $language['id'] }}">
                            {{{ $language['language'] }}}
                        </option>
                    @endforeach
                    </select>
                </div><!-- /controls -->
            </div><!-- /control-group -->

            <div class='control-group'>
                <label class='control-label' for='title'>Kort omschrijving</label>

                <div class='controls'>
                    <input class='span6' id='title' name='description' placeholder=
                    'eg. This category contains all news' type='text' value="{{ Session::get('input.description') }}">
                </div><!-- /controls -->
            </div><!-- /control-group -->

            <div class='form-actions'>
                <button class='btn btn-primary' type='submit'>Submit</button>
                <button class='btn' type='reset'>Reset</button>
            </div><!-- /form-actions -->
        </fieldset>
    </form>
@stop