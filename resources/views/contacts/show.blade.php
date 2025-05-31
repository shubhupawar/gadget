@extends('layouts.app')

@section('content')
<h1>Contact Details</h1>

<div class="card mt-3" style="max-width: 600px;">
    <div class="card-body">
        <h5 class="card-title">{{ $contact->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $contact->email }}</h6>
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
        <p><strong>Message:</strong><br />{{ $contact->message }}</p>
        <p>
            <strong>Image:</strong><br />
            @if($contact->image)
                <img src="{{ asset('gadget/public/uploads/'.$contact->image) }}" alt="image" class="img-fluid rounded" />
            @else
                No image uploaded.
            @endif
        </p>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to Contacts</a>
        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-primary ms-2">Edit Contact</a>
    </div>
</div>
@endsection
