@extends('theme.layout')
@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="">Rooms</a></li>
            <li class="breadcrumb-item active">{{ $room->title }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Room Image Section -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <img src="{{ asset('storage/'.$room->image) }}" 
                     alt="{{ $room->title }}" 
                     class="card-img-top rounded" 
                     style="height: 500px; object-fit: cover;">
            </div>
        </div>

        <!-- Booking Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow sticky-top" style="top: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h2 text-primary mb-0">${{ $room->rent }}</h3>
                        <small class="text-muted">per night</small>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('add_booking') }}" method="POST">
                        @csrf
                        <div class="border-top border-bottom py-3 mb-3">
                            <div class="mb-2">
                                <small class="text-muted">Check-in</small>
                                <input type="text" name="start_date" class="form-control" id="checkin">
                            </div>
                            <div>
                                <small class="text-muted">Check-out</small>
                                <input type="text" name="end_date" class="form-control" id="checkout">
                            </div>
                        </div>
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Book Now</button>
                        <p class="text-center text-muted small mb-0">You won't be charged yet</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Details -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h2 mb-2">{{ $room->title }}</h1>
                    <div class="d-flex align-items-center mb-4">
                       <span class="badge me-2 fs-4 px-1 py-0.5" style="background-color: #87CEEB; color: #1a1a1a; font-weight: 500;">{{ $room->type }}</span>
                        <span class="text-muted ml-2">
                            <i class="bi bi-star-fill text-warning"></i> 4.8 (124 reviews)
                        </span>
                    </div>

                    <hr class="my-4">

                    <h3 class="h5 mb-3">About this room</h3>
                    <p class="text-muted">{{ $room->description }}</p>

                    <hr class="my-4">

                    <h3 class="h5 mb-3">Amenities</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-wifi fs-4 text-primary me-3"></i>
                                <div>
                                    <strong>WiFi</strong>
                                    <p class="mb-0 small text-muted">{{ $room->facility }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-tv fs-4 text-primary me-3"></i>
                                <div>
                                    <strong>TV</strong>
                                    <p class="mb-0 small text-muted">Smart TV included</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-snow fs-4 text-primary me-3"></i>
                                <div>
                                    <strong>Air Conditioning</strong>
                                    <p class="mb-0 small text-muted">Climate control</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-cup-hot fs-4 text-primary me-3"></i>
                                <div>
                                    <strong>Breakfast</strong>
                                    <p class="mb-0 small text-muted">Complimentary</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const bookedObj = @json($bookedDates); // your object
    const bookedDates = Object.values(bookedObj); // now it's an array
    console.log(bookedDates); 

    flatpickr("#checkin", {
        noCalendar: false, 
        disable: bookedDates,
        // minDate: "today"
    });
    flatpickr("#checkout", {
        noCalendar: false, 
        disable: bookedDates,
        // minDate: "today"
    });

    let selectedDate = ""; // global variable to store the selected date

    // Add event listener
    const checkinInput = document.getElementById("checkin");
    checkinInput.addEventListener("change", function() {
        selectedDate = this.value; // assign the selected date
        const selected = new Date(selectedDate);
        let firstBooked = null;

        for (const date of bookedDates) {
            const dated = new Date(date);
            // Assign the first booked date greater than selected
            if (selected < dated) {
                if (firstBooked === null || dated < firstBooked) {
                    firstBooked = dated;
                }
            }
        }

        if(firstBooked && selected < firstBooked){
            flatpickr("#checkout", {
                maxDate: firstBooked,
                disable: bookedDates,
            });
        }else{
            flatpickr("#checkout", {
                maxDate: null,
                disable: bookedDates,
            });
        }   
    });
    // Add event listener
    const checkoutInput = document.getElementById("checkout");
    checkoutInput.addEventListener("change", function() {
        selectedDate = this.value; // assign the selected date
        const selected = new Date(selectedDate);
        let firstBooked = null;

        for (const date of bookedDates) {
            const dated = new Date(date);
            // Assign the first booked date greater than selected
            if (selected > dated) {
                if (firstBooked === null || dated > firstBooked) {
                    firstBooked = dated;
                }
            }
        }

        if(firstBooked && selected > firstBooked){
            flatpickr("#checkin", {
                minDate: firstBooked,
                disable: bookedDates,
            });
        }else{
            flatpickr("#checkin", {
                minDate: null,
                disable: bookedDates,
            });
        }   
    });
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
@endpush