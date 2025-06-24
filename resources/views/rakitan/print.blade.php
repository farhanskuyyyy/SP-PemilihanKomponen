<!DOCTYPE html>
<html>
<head>
    <title>Cetak Rakitan Komputer: {{ $rakitan->name }}</title>
    <meta charset="utf-8">
    <style>
        @media print {
            body { background: #fff !important; color: #222; }
            .no-print { display: none; }
            .print-card { box-shadow: none; border: none; }
        }
        body {
            background: #f2f2f2;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0; padding: 0;
        }
        .print-card {
            background: #fff;
            max-width: 600px;
            margin: 30px auto;
            padding: 32px 32px 18px 32px;
            border-radius: 14px;
            box-shadow: 0 6px 24px rgba(50,50,50,0.13);
        }
        h1 {
            font-size: 2.1em;
            text-align: center;
            color: #184eb7;
            margin-top: 0;
        }
        table {
            width: 100%;
            margin: 26px 0 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 6px;
            text-align: left;
            border-bottom: 1px solid #ececec;
            font-size: 1em;
        }
        th { background: #f7f7fc; color: #555; }
        .label {
            color: #999; font-size: 0.93em;
        }
        .value {
            color: #223;
        }
        .footer-print {
            font-size: 0.93em;
            color: #777;
            text-align: center;
            margin-top: 28px;
        }
        .brand {
            font-size: 1.08em;
            font-weight: bold;
            color: #366cc7;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="print-card">
        <h1>{{ $rakitan->name }}</h1>
        <table>
            <tr>
                <th class="label">Komponen</th>
                <th class="label">Detail</th>
            </tr>
            <tr>
                <td>Motherboard</td>
                <td class="value">{{ $rakitan->motherboardRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Processor</td>
                <td class="value">{{ $rakitan->processorRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>RAM</td>
                <td class="value">{{ $rakitan->ramRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Casing</td>
                <td class="value">{{ $rakitan->casingRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Storage Utama</td>
                <td class="value">{{ $rakitan->storagePrimaryRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Storage Secondary</td>
                <td class="value">{{ $rakitan->storageSecondaryRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>VGA</td>
                <td class="value">{{ $rakitan->vgaRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>PSU</td>
                <td class="value">{{ $rakitan->psuRelation->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Monitor</td>
                <td class="value">{{ optional($rakitan->monitorRelation)->name ?? '-' }}</td>
            </tr>
        </table>

        <div class="footer-print">
            Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}<br>
            <span class="brand">Workspace Brunniess Seven</span>
        </div>
        <div class="no-print" style="text-align:center;margin-top:18px;">
            <button onclick="window.print()" style="padding:7px 22px;border-radius:8px;background:#366cc7;color:#fff;border:none;font-size:1.1em;cursor:pointer;">
                <span>&#128438;</span> Print
            </button>
            <br><small style="color:#aaa;">Tekan tombol di atas atau <b>Ctrl+P</b> untuk mencetak</small>
        </div>
    </div>
</body>
</html>
