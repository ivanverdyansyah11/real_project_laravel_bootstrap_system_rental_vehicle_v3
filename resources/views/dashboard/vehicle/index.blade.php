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
                        <form class="form w-100" method="GET">
                            <input type="search" class="input w-100" id="search" placeholder="Search vehicle.."
                                autocomplete="off" name="search" value="{{ $search != null ? $search : '' }}">
                        </form>
                        <a href="{{ route('vehicle.create') }}" class="button-primary-small d-none d-md-inline-block">Add
                            New Vehicle</a>
                    </div>
                    <div class="wrapper-table mt-4">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Stnk Name</th>
                                    <th>License Plate Number</th>
                                    <th>Kilometer</th>
                                    <th>Capacity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($vehicles->count() == 0)
                                    <td colspan="8">Data vehicle not found!</td>
                                @else
                                    @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->name }}</td>
                                            <td>{{ $vehicle->stnk_name }}</td>
                                            <td>{{ $vehicle->license_plate_number }}</td>
                                            <td>{{ $vehicle->kilometer }} Km</td>
                                            <td>{{ $vehicle->capacity }} Person</td>
                                            <td>{{ formatRupiah($vehicle->price) }}</td>
                                            <td>{{ $vehicle->status == 1 ? 'Active' : 'Unactive' }}</td>
                                            <td class="d-flex justify-content-end gap-1 table-mobile" style="width: 200px;">
                                                <a href="{{ route('vehicle.show', $vehicle->id) }}"
                                                    class="wrapper-icon icon-detail d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-eye" style="font-size: 0.85rem;"></i>
                                                </a>
                                                @if (auth()->user()->admin)
                                                    <a href="{{ route('vehicle.edit', $vehicle->id) }}"
                                                        class="wrapper-icon icon-edit d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-pen-to-square"
                                                            style="font-size: 0.85rem;"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="wrapper-icon icon-delete d-flex align-items-center justify-content-center"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $vehicle->id }}">
                                                        <i class="fa-solid fa-trash-can" style="font-size: 0.85rem;"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="wrapper-paginate">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.vehicle')
@endsection

@push('child-script')
    <script>
        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteVehicle').attr('action', '/vehicle/' + id);
        });
    </script>
@endpush
