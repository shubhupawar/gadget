@extends('layouts.app')

@section('content')
    <h1>Edit Contact</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="contactForm" action="{{ route('contacts.update', $contact) }}" method="POST" enctype="multipart/form-data"
        class="mt-3" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $contact->name) }}" class="form-control" required
                minlength="2" maxlength="100" title="Please enter a valid name (2-100 characters)" />
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="form-control" required
                maxlength="150" title="Please enter a valid email address" />
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="tel" name="phone" value="{{ old('phone', $contact->phone) }}" class="form-control" required
                pattern="[0-9]{10}" maxlength="10" minlength="10" title="Enter a valid 10-digit phone number" />
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" rows="4" class="form-control" required minlength="5" maxlength="500"
                title="Message must be between 5 and 500 characters">{{ old('message', $contact->message) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br />
            @if($contact->image)
                <img src="{{ asset('gadget/public/uploads/' . $contact->image) }}" alt="image"
                    style="max-width: 100px; border-radius: 5px;" />
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" title="Only image files are allowed" />
        </div>

        <button type="submit" class="btn btn-primary">Update Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
    <script>
        $(document).ready(function () {
            $('#contactForm').submit(function (e) {
                const name = $.trim($("input[name='name']").val());
                const email = $.trim($("input[name='email']").val());
                const phone = $.trim($("input[name='phone']").val());
                const message = $.trim($("textarea[name='message']").val());
                const imageFile = $("input[name='image']")[0]?.files[0];

                const errors = [];
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                const nameRegex = /^[a-zA-Z\s.]+$/;
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                const maxSizeInBytes = 1 * 1024 * 1024;

                if (!nameRegex.test(name)) errors.push("Name can only contain letters, spaces, and periods.");
                if (!emailRegex.test(email)) errors.push("Invalid email format.");
                if (!/^\d{10}$/.test(phone)) errors.push("Phone number must be exactly 10 digits.");
                if (message.length < 5 || message.length > 500) errors.push("Message must be between 5 and 500 characters.");

                if (imageFile) {
                    const ext = imageFile.name.split('.').pop().toLowerCase();
                    if (!allowedExtensions.includes(ext)) errors.push("Only image files (jpg, jpeg, png, gif, webp) are allowed.");
                    if (imageFile.size > maxSizeInBytes)verrors.push("Image size should be less than 1 MB.");
                }

                if (errors.length) {
                    e.preventDefault();
                    alert(errors.join("\n"));
                }
            });
        });
    </script>

@endsection