@extends('layouts.auth')


@section('title', __('Восстановление пароля'))

@section('content')
    <x-forms.auth-forms :title="__('Восстановление пароля')"
                        action="{{ route('password-reset.handle') }}"
                        method="post"
    >
        @csrf

        <input type="hidden" value="{{ $token }}" name="token">

        <x-forms.text-input
                name="email"
                type="email"
                placeholder="E-mail"
                required="true"
                value="{{ request('email') }}"
                :isError="$errors->has('email')"
        ></x-forms.text-input>

        @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
        @enderror

        <x-forms.text-input
                name="password"
                type="password"
                placeholder="Пароль"
                value="{{ request('email') }}"
                required="true"
        ></x-forms.text-input>

        @error('password')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
                name="password_confirmation"
                type="password"
                placeholder="Поторите пароль"
                required="true"
        ></x-forms.text-input>

        @error('password_confirmation')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.primary-button type="submit">Обновить пароль</x-forms.primary-button>

        <x-slot:socialAuth></x-slot:socialAuth>


        <x-slot:buttons></x-slot:buttons>

    </x-forms.auth-forms>
@endsection
