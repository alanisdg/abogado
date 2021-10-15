@extends('layouts.app')

@section('title', 'Logs')

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">#</th>
                                    <th scope="col">USUARIO</th>
                                    <th scope="col">ACCION</th>
                                    <th scope="col">TARGET</th>
                                    <th scope="col">FECHA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $data)
                                <tr>
                                    <th scope="row">{{ $data->id }}</th>
                                    <td>{{ $data->user->first_name }}</td>
                                    <td>{{ $data->action }}</td>


                                    @if($data->target_id != null)
                                    <td>{{ $data->target->names }}</td>
                                    @endif

                                    @if($data->contract_id != null)
                                    <td>{{ $data->contract }}</td>
                                    @endif
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center">
                            {!! $logs->links() !!}
                        </div>
                    </div>
                </div>
            </div>



          </div>
    </section>
@endsection

@section("scripts")
    <script>

    </script>
@endsection
