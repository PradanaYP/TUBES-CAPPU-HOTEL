@extends('layouts.main')

@section('title', 'Homepage')

@section('content')
    @include('components.header')

    <div class="container mt-5">
        <!-- Header -->
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-md-2">
                <img src="/images/download (3).jpg" class="img-fluid" alt="Logo Hotel">
            </div>
            <div class="col-md-3">
                <h1 class="mb-0 font-playfair">Cappu Hotel</h1>
            </div>
        </div>

        <!-- LIST KAMAR -->
        <div class="row g-4 mb-5" data-aos="fade-up">
            @foreach ($roomTypes as $room)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('room.show', $room->id) }}">
                            <img src="{{ asset('storage/' . $room->overview_image) }}" class="card-img-top" alt="{{ $room->type_name }}" style="height: 220px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->type_name }}</h5>
                            <p class="card-text">Starting from Rp{{ number_format($room->price_per_night, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Testimonials -->
        <div class="row align-items-center mb-4" data-aos="fade-right">
            <div class="col-md-8">
                <h2>Customer Testimonials</h2>
            </div>
        </div>

        <div class="row g-4 mb-5" data-aos="fade-up">
            @foreach ([
                ['name' => 'John Doe', 'image' => '/images/John doe.jpg', 'comment' => 'Great service and luxurious experience!', 'button' => 'Repeat Visitor'],
                ['name' => 'Jane Smith', 'image' => '/images/Jane Smith.jpg', 'comment' => 'Amazing views and top-notch amenities!', 'button' => 'Repeat Booking'],
            ] as $testi)
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ $testi['image'] }}" width="50" height="50" alt="{{ $testi['name'] }}" class="rounded-circle me-3">
                            <div>
                                <h5 class="mb-1">{{ $testi['name'] }}</h5>
                                <p class="mb-1">{{ $testi['comment'] }}</p>
                                <button class="btn btn-sm btn-outline-secondary">{{ $testi['button'] }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Guest Reviews -->
        <div class="d-flex align-items-center mb-4" data-aos="zoom-in">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2563EB" class="me-2" viewBox="0 0 24 24">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
            <h2 class="mb-0">Guest Reviews</h2>
        </div>

        <div class="row g-4 mb-5" data-aos="fade-up">
            @foreach ([
                ['name' => 'Alex Johnson', 'image' => '/images/Alex Johnson.jpg', 'review' => 'Fantastic stay with excellent staff and facilities'],
                ['name' => 'Alex Johnson', 'image' => 'https://static.vecteezy.com/system/resources/previews/027/245/487/non_2x/male-3d-avatar-free-png.png', 'review' => 'Incredible service and beautiful rooms'],
            ] as $review)
                <div class="col-md-6">
                    <div class="card p-3 bg-light">
                        <div class="d-flex align-items-center">
                            <img src="{{ $review['image'] }}" width="50" height="50" class="rounded-circle me-3" alt="{{ $review['name'] }}">
                            <div>
                                <h5 class="mb-0">{{ $review['name'] }}</h5>
                                <p class="mb-1 text-warning">★★★★★</p>
                                <p>{{ $review['review'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Destinations -->
        <h2 class="mb-4 text-center" data-aos="fade-down">Popular Destinations</h2>
        <div class="row g-4 mb-5" data-aos="fade-up">
            @foreach ([
                ['icon' => '🏖️', 'title' => 'Beach Resorts', 'desc' => 'Relax by the ocean'],
                ['icon' => '🏰', 'title' => 'Historic Cities', 'desc' => 'Explore culture and heritage'],
                ['icon' => '🌄', 'title' => 'Mountain Escapes', 'desc' => 'Breathtaking views'],
            ] as $dest)
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <span style="font-size: 50px;">{{ $dest['icon'] }}</span>
                        </div>
                        <h5 class="mt-3 mb-1">{{ $dest['title'] }}</h5>
                        <p class="text-muted">{{ $dest['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('components.footer')
@endsection
