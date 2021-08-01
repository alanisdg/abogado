<div class="row" id="basic-table">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Plan de Pago Actual</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número de Cuota</th>
                            <th>Fecha de Pago</th>
                            <th>Monto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalOwed = 0;
                        @endphp
                        @forelse ($row->collections as $item)
                            @if ($item->status == "PENDIENTE")
                                @php
                                    $totalOwed += floatval(str_replace('.', '', $item->amount))
                                @endphp
                            @endif
                            <tr>
                                <td>
                                   {{ $item->installment_number }}
                                </td>
                                <td>{{ date("d-m-Y", strtotime($item->payment_date)) }}</td>
                                <td> <strong>$</strong>{{ $item->amount }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <strong>Total Adeudado: ${{ number_format($totalOwed, 0, '', '.') }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
      </div>
    </div>
</div>
