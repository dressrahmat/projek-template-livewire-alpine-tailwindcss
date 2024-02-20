@extends('layouts.app')
@section('content')
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>
    
        <div>
            <div class="mx-auto sm:px-6 lg:px-8 w-full">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 sm:p-8 bg-base-content text-base=100 shadow-lg sm:rounded-lg">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                
                    <div class="p-4 sm:p-8 bg-base-content text-base=100 shadow-lg sm:rounded-lg">
                        @include('profile.partials.update-password-form')
                    </div>
                
                    <div class="p-4 sm:p-8 bg-base-content text-base=100 shadow-lg sm:rounded-lg h-fit">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection