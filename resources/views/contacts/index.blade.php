@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @else (!session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (localStorage.getItem('exportSuccess') === 'true') {
                    const container = document.createElement('div');
                    container.className = 'container mt-3'; // Bootstrap container with top margin

                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.role = 'alert';
                    alertDiv.innerHTML = `
                            Contacts exported successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `;

                    container.appendChild(alertDiv);

                    // Insert the container at the top of the body or inside a specific parent element
                    document.body.insertBefore(container, document.body.firstChild);

                    localStorage.removeItem('exportSuccess');
                }
            });
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Contacts</h1>
        <div>
            <button id="exportBtn" class="btn btn-dark me-2">Export</button>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add New Contact</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Today</h5>
                    <p class="card-text fs-2">{{ $todayCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Yesterday</h5>
                    <p class="card-text fs-2">{{ $yesterdayCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Day Before Yesterday</h5>
                    <p class="card-text fs-2">{{ $dayBeforeYesterdayCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td><a href="{{ route('contacts.show', $contact) }}">{{ $contact->name }}</a></td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        @if($contact->image)
                            <img src="{{ asset('gadget/public/uploads/' . $contact->image) }}" alt="image" width="50" height="60"
                                style="object-fit: cover;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('contacts.delete', $contact) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this contact?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No contacts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $contacts->links() }}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('exportBtn').addEventListener('click', function () {
                const link = document.createElement('a');
                link.href = "{{ route('contacts.export') }}";
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                localStorage.setItem('exportSuccess', 'true');
                setTimeout(() => {
                    window.location.href = "{{ route('contacts.index') }}";
                }, 1000);
            });
        });
    </script>

@endsection