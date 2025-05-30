@extends('layouts.main')
@section('title', 'Settings')
@section('content')
@include('components.header')

<!-- User Information -->
<section class="bg-primary text-white py-5">
    <div class="container d-flex flex-column flex-md-row align-items-center gap-4">
        <!-- Profile Picture -->
        <div class="position-relative">
            @if(Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" 
                     alt="User Avatar" 
                     class="rounded-circle p-1" 
                     width="100" 
                     height="100" 
                     style="object-fit: cover;" />
            @else
                <img src="{{ asset('images/John doe.jpg') }}" 
                     alt="User Avatar" 
                     class="rounded-circle p-1" 
                     width="100" 
                     height="100" />
            @endif
            
            <!-- Upload Button -->
            <button type="button" 
                    class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle p-1 d-flex justify-content-center align-items-center" 
                    data-bs-toggle="modal" 
                    data-bs-target="#profilePictureModal"
                    style="width: 30px; height: 30px; font-weight: bold; font-size: 18px;">
                +
            </button>
        </div>
        
        <div class="text-center text-md-start">
            <h2 class="h5 fw-bold mb-1">{{ Auth::user()->name }}</h2>
            <span class="p-1 mb-3 bg-secondary text-white rounded-2">
                {{ Auth::user()->user_type ?? 'VIP Guest' }}
            </span>
            <p class="mb-0">Thank you for choosing MyHotel.</p>
        </div>
    </div>
</section>

<!-- Form -->
<section class="container my-5">
    <div class="mx-auto" style="max-width: 500px;">
        
        <!-- Success Message -->
        @if(session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profile updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Profile Information Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Profile Information</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name"
                               value="{{ old('name', Auth::user()->name) }}" 
                               required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email"
                               value="{{ old('email', Auth::user()->email) }}" 
                               required />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account Form -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Delete Account</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                </p>
                <button type="button" 
                        class="btn btn-danger" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteAccountModal">
                    Delete Account
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Profile Picture Modal -->
<div class="modal fade" id="profilePictureModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.picture.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Choose Image</label>
                        <input type="file" 
                               class="form-control" 
                               id="profile_picture" 
                               name="profile_picture" 
                               accept="image/*" 
                               required />
                        <div class="form-text">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                    <div class="mb-3">
                        <label for="delete_password" class="form-label">Enter your password to confirm</label>
                        <input type="password" 
                               class="form-control" 
                               id="delete_password" 
                               name="password" 
                               required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('components.footer')
@endsection