@extends('admin.dashboard._content')
@include('admin._alert')
@section('form')
    @if (is_null(Session::get('input.abbreviation')))
        {{-- Store --}}
        <form action="{{ route('admin.dashboard.language.store') }}" class='form-horizontal' method='post'>
    @else
        {{-- Update --}}
        <form action="{{ route('admin.dashboard.language.update', Session::get('input.id')) }}" class='form-horizontal' method='post'>
    @endif
        @yield('error')
        @yield('warning')
        @yield('success')
        @yield('info')
        <fieldset>
            <div class='control-group'>
                <label class='control-label' for='language'>Language</label>
                <div class='controls'>
                    <input class='span6' id='language' name='language' placeholder=
                    'eg. Dutch, English, Chinese' type='text' value="{{ Session::get('input.language') }}" autofocus required>
                </div><br/><!-- /controls -->
                
                <label class='control-label' for='abbreviation'>Abbreviation</label>
                <div class='controls'>
                    <input type="text" id="abbreviation" name="abbreviation" placeholder="eg. nl, en, zh"
                    value="{{ Session::get('input.abbreviation') }}" maxlength="6" required>
                </div><!-- /controls -->
            </div><!-- /control-group -->

            <div class='form-actions'>
                <button class='btn btn-primary' type='submit'>Submit</button>
                <button class='btn' type='reset'>Reset</button>
            </div><!-- /form-actions -->
        </fieldset>
    </form>
@stop