@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pt-2">
                    <div class="card">
                        <div class="card-header">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <h3 class="card-title">Currency Information</h3>
                            <a href="{{ route('currencyUpdate') }}" class="float-right">
                                <button type="button" class="btn btn-normal btn-outline-success float-right">Update
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            @if (isset($data[0]))
                                <table class="table table-bordered table-hover table-responsive-sm table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">num_code</th>
                                            <th class="text-center">char_code</th>
                                            <th class="text-center">nominal</th>
                                            <th class="text-center">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = $data->perPage() * ($data->currentPage() - 1);@endphp
                                        @foreach ($data as $item)
                                            @php $i++;@endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['num_code'] }}</td>
                                                <td>{{ $item['char_code'] }}</td>
                                                <td>{{ $item['nominal'] }}</td>
                                                <td>{{ $item['value'] }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <p class="alert alert-warning">No data found! please check update button for latest data
                                    thank you.</p>
                            @endif
                        </div>

                    </div>
                    <div class="d-flex justify-content-center">

                        {!! $data->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
