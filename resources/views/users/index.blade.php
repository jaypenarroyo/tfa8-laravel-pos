@extends('layouts.app')

@section('title', 'Users | POS Foundations')

@section('content')
<section class="page-hero compact">
    <div class="container">
        <p class="eyebrow">Team access</p>
        <h1>User Accounts</h1>
        <p class="lead">User records retrieved from the database through the User Eloquent model.</p>
    </div>
</section>

<section class="section table-section">
    <div class="container">
        <div class="list-toolbar">
            <div class="table-meta"><span>{{ count($users) }} user records</span><span>Database records</span></div>
            <a class="button primary compact-button" href="{{ route('users.create') }}">Add user</a>
        </div>
        <div class="table-card">
            <table class="compact-table">
                <thead><tr><th>Avatar</th><th>ID</th><th>Username</th><th>Full name</th><th>Email</th><th>Action</th></tr></thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img class="avatar" src="{{ $user->avatar ? Storage::disk('public')->url($user->avatar) : asset('images/avatar-placeholder.svg') }}" alt="Avatar for {{ $user->full_name }}">
                        </td>
                        <td><strong>{{ $user->id }}</strong></td>
                        <td><span class="username">{{ $user->username }}</span></td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="inline-actions">
                                <a class="table-action" href="{{ route('users.show', $user) }}">View</a>
                                <a class="table-action" href="{{ route('users.edit', $user) }}">Edit</a>
                                @if (auth()->id() !== $user->id)
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="table-action danger-action" type="submit">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <p class="data-note">Records are loaded from the <code>users</code> table using <code>User::orderBy('id')->get()</code>.</p>
    </div>
</section>
@endsection
