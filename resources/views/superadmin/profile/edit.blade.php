@extends('layouts.app')
@section('content')
<div>
    @livewire('profile.edit', ['user' => $user])
</div>
@endsection