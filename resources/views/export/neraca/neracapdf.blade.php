<h1>Tabel Neraca</h1>

<table class="table" style="border: 1px solid black; border-collapse:collapse;">
    <thead style="border: 1px solid black;">
        <tr style="background-color: black; color: white;">
            <th style="width: 80px; font-size: 12px;">Nomor Transaksi</th>
            <th style="width: 80px; font-size: 12px;">Transaksi</th>
            <th style="width: 80px; font-size: 12px;">Deskripsi</th>
            <th style="width: 100px; font-size: 12px;">Debit (Rp)</th>
            <th style="width: 100px; font-size: 12px;">Kredit (Rp)</th>
            <th style="width: 100px; font-size: 12px;">Tanggal</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid black;">
        @foreach ($neraca as $n)
        <tr>
            <td style="font-size: 10px; border: 1px solid black">{{$n->nomor_akun}}</td>
            <td style="width: 80px;font-size: 10px; border: 1px solid black">{{$n->akun}}</td>
            <td style="width: 80px; font-size: 10px; border: 1px solid black">{{$n->deskripsi}}</td>
            <td style="font-size: 10px; border: 1px solid black; text-align: right;">{{number_format($n->debit, 2, ',', '.') }}</td>
            <td style="font-size: 10px; border: 1px solid black; text-align: right;">{{number_format($n->kredit, 2, ',', '.') }}</td>
            <td style="font-size: 10px; border: 1px solid black">{{$n->formattanggal()}}</td>
        </tr>
        @endforeach
        <tr style="border: 1px solid black;">
            <td></td>
            <td></td>
            <td style="font-size: 12px;">Total (Rp)</td>
            <td style="border: 1px solid black; font-size: 12px; text-align: right;">
                    {{number_format($sumdebit, 2, ',', '.') }}
            </td>
            <td style="border: 1px solid black; font-size: 12px; text-align: right;">
                    {{number_format($sumkredit, 2, ',', '.') }}
            </td>
            <td></td>
        </tr>
        <tr style="border: 1px solid black;">
            <td></td>
            <td></td>
            <td style="font-size: 12px;">Saldo (Rp)</td>
            <td></td>
            <td></td>
            @if ($balance > 0 )
            <td style="border: 1px solid black; background-color: green; color: white; font-size: 12px; text-align: right;">
                    {{number_format($balance, 2, ',', '.') }}
            </td>
            @elseif ($balance <= 0)
            <td style="border: 1px solid black; background-color: red; color: white; font-size: 12px; text-align: right;">
                    {{number_format($balance, 2, ',', '.') }}
            </td>
            @endif
        </tr>
    </tbody>
</table>
