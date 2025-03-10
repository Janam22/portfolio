@extends('layouts.admin.app')

@section('title',\App\Models\BusinessSetting::where(['key'=>'business_name'])->first()->value??'Dashboard')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        @if(auth('admin')->user()->role_id == 1)
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="page--header-title">
                    <h1 class="page-header-title">{{translate('messages.welcome')}}, {{auth('admin')->user()->f_name}}.</h1>
                    <p class="page-header-text">{{translate('messages.Hello,_here_you_can_manage_your_system.')}}</p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        @else
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{translate('messages.welcome')}}, {{auth('admin')->user()->f_name}}.</h1>
                    <p class="page-header-text">{{translate('messages.Hello,_here_you_can_manage_your_roles.')}}</p>
                </div>
                
                @if(!$hasCheckedIn) <!-- Only show if not checked in -->
                    <div>          
                        <button type="button" onclick="getcheckinLocation()" class="btn btn--primary">
                            <i class="tio-dashboard-vs ml-xl-2"></i>{{translate('messages.checkin')}}
                        </button>
                    </div>
                @elseif(!$hasCheckedOut)
                    <div>          
                        <button type="button" onclick="getcheckoutLocation()" class="btn btn--secondary">
                            <i class="tio-dashboard-vs ml-xl-2"></i>{{translate('messages.checkout')}}
                        </button>
                    </div>
                @else
                    <p style="color:green;">Attendance completed for today.</p>
                @endif
            </div>
        </div>
        <!-- End Page Header -->
        @endif
    </div>
@endsection

<script>
function getcheckinLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                let ci_lat = position.coords.latitude;
                let ci_lon = position.coords.longitude;

                // Send to Laravel Backend
                fetch("{{ route('admin.attendance.checkin') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        ci_lat: ci_lat,
                        ci_lon: ci_lon
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        toastr.success(data.message); // Show Toastr notification
                        setTimeout(() => {
                            location.reload(); // Reload after showing Toastr
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    toastr.error("An error occurred. Please try again.");
                });
            }, 
            function(error) {
                toastr.error(getGeolocationError(error));
            },
            {
                enableHighAccuracy: true, // Ensure precise tracking
                timeout: 60000, // Maximum wait time of 10 seconds
                maximumAge: 0 // Prevents caching of old location data
            }
        );
    } else {
        toastr.error("Geolocation is not supported by this browser.");
    }
}

function getcheckoutLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                let co_lat = position.coords.latitude;
                let co_lon = position.coords.longitude;

                // Send to Laravel Backend
                fetch("{{ route('admin.attendance.checkout') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        co_lat: co_lat,
                        co_lon: co_lon
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        toastr.success(data.message); // Show Toastr notification
                        setTimeout(() => {
                            location.reload(); // Reload after showing Toastr
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    toastr.error("An error occurred. Please try again.");
                });
            }, 
            function(error) {
                toastr.error(getGeolocationError(error));
            },
            {
                enableHighAccuracy: true, // Ensure precise tracking
                timeout: 60000, // Maximum wait time of 10 seconds
                maximumAge: 0 // Prevents caching of old location data
            }
        );
    } else {
        toastr.error("Geolocation is not supported by this browser.");
    }
}

// Function to handle geolocation errors
function getGeolocationError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            return "Location access denied. Please allow location permission.";
        case error.POSITION_UNAVAILABLE:
            return "Location information is unavailable. Try again later.";
        case error.TIMEOUT:
            return "Location request timed out. Ensure GPS is on and retry.";
        case error.UNKNOWN_ERROR:
            return "An unknown error occurred while fetching location.";
        default:
            return "An unexpected error occurred.";
    }
}
</script>