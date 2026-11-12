<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kritik & Saran</title>
    <style>
        body { color: #172033; font: 12px Arial, sans-serif; margin: 24px; }
        h1 { font-size: 20px; margin: 0 0 4px; }
        .meta { color: #526071; margin-bottom: 18px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #eef2f6; }
        .reply { margin-top: 6px; color: #075985; }
        .print-button { background: #0c3866; border: 0; border-radius: 4px; color: white; cursor: pointer; margin-bottom: 16px; padding: 8px 12px; }
        @media print {
            body { margin: 0; }
            .print-button { display: none; }
            tr { break-inside: avoid; }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">Cetak / Simpan sebagai PDF</button>
    <h1>Laporan Kritik & Saran</h1>
    <div class="meta">BNN Kota Jakarta Timur · Dicetak {{ now()->translatedFormat('d F Y, H:i') }} · {{ $feedbacks->count() }} masukan</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Kategori & Pesan</th>
                <th>Status & Balasan Admin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->created_at->translatedFormat('d M Y, H:i') }}</td>
                    <td>{{ $feedback->name }}<br>{{ $feedback->email }}</td>
                    <td><strong>{{ $feedback->category_label }}</strong><br>{{ $feedback->message }}</td>
                    <td>{{ $feedback->status === 'replied' ? 'Sudah dibalas' : 'Menunggu balasan' }}
                        @if($feedback->admin_reply)
                            <div class="reply">{{ $feedback->admin_reply }}</div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Tidak ada masukan untuk filter yang dipilih.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
