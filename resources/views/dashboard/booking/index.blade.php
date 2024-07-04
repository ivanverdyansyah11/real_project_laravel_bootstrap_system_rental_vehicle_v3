@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success w-100 mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card-default">
                    <div class="wrapper d-flex align-items-center justify-content-between gap-2">
                        <form class="form w-100 d-flex gap-2" method="GET">
                            <input type="date" class="input w-100" id="pickup_date" placeholder="Search pickup date.."
                                autocomplete="off" name="pickup_date"
                                value="{{ $search->pickup_date != null ? $search->pickup_date : '' }}">
                            <input type="date" class="input w-100" id="search" placeholder="Search return date.."
                                autocomplete="off" name="return_date"
                                value="{{ $search->return_date != null ? $search->return_date : '' }}">
                            <button type="submit" class="button-primary-small" style="width: 46px; height: 46px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <a href="{{ route('booking.create') }}" class="button-primary-small d-none d-md-inline-block">Add
                            New
                            Booking</a>
                    </div>
                    <div class="wrapper-table mt-4">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Phone Number</th>
                                    <th>Car Name</th>
                                    <th>Send Address</th>
                                    <th>Pickup Date</th>
                                    <th>Return Date</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($bookings->count() == 0)
                                    <td colspan="7">Data booking not found!</td>
                                @else
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->customer->fullname }}</td>
                                            <td>{{ $booking->customer->phone_number }}</td>
                                            <td>{{ $booking->vehicle->name }}</td>
                                            <td>{{ $booking->send_address }}</td>
                                            <td>{{ $booking->pickup_date }}</td>
                                            <td>{{ $booking->return_date }}</td>
                                            <td class="d-flex justify-content-end gap-1 table-mobile" style="width: 200px;">
                                                @if ($booking->status != 2)
                                                    <a href="{{ route('booking.edit', $booking->id) }}"
                                                        class="wrapper-icon icon-edit d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-circle-check" style="font-size: 0.85rem;"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('booking.show', $booking->id) }}"
                                                    class="wrapper-icon icon-detail d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-eye" style="font-size: 0.85rem;"></i>
                                                </a>
                                                <button type="button"
                                                    class="wrapper-icon icon-delete d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $booking->id }}">
                                                    <i class="fa-solid fa-trash-can" style="font-size: 0.85rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="wrapper-paginate">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.booking')
@endsection

@push('child-script')
    <script>
        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteBooking').attr('action', '/booking/' + id);
        });
    </script>
@endpush
