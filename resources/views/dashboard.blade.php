<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        {{-- User Table --}}
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th><a href="{{ route('dashboard', ['sort' => 'username', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">Username</a></th>
                                                    <th><a href="{{ route('dashboard', ['sort' => 'name', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">Name</a></th>
                                                    <th><a href="{{ route('dashboard', ['sort' => 'email', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">Email</a></th>
                                                    <th>Preview</th>
                                                    <th>Status</th>
                                                    <th>Deactivate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userPreviewModal-{{ $user->id }}">
                                                                Preview
                                                            </button>
                                                        </td>
                                                        <td>{{ $user->status ? 'Active' : 'Deactivated' }}</td>
                                                        <td>
                                                            <form action="{{ route('users.deactivate', $user->id) }}" method="POST">
                                                                @csrf
                                                                @if($user->status)
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to deactivate this user?')">Deactivate</button>
                                                                @else
                                                                    <button type="button" class="btn btn-secondary" disabled>Deactivated</button>
                                                                @endif
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        @foreach ($users as $user)
                                            <!-- Modal -->
                                            <div class="modal fade" id="userPreviewModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId-{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">User Information</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- User Information Here -->
                                                            <p><strong>ID:</strong> {{ $user->id }}</p>
                                                            <p><strong>Username:</strong> {{ $user->username }}</p>
                                                            <p><strong>Name:</strong> {{ $user->name }}</p>
                                                            <p><strong>Email:</strong> {{ $user->email }}</p>
                                                            <!-- Add more fields as needed -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Pagination Links -->
                                        {{ $users->links() }}
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
