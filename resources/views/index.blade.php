@extends('layouts.app')

@section('content')
    @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            @method('delete')
            <x-forms.primary-button>Выйти</x-forms.primary-button>
        </form>
    @endauth

@endsection
