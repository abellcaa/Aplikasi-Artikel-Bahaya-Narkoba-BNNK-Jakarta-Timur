<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan Kritik & Saran BNN Kota Jakarta Timur</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 24px 12px;
            color: #1e293b;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            background-color: #0f3a69;
            color: #ffffff;
            padding: 28px 24px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0 0 6px 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .email-header p {
            margin: 0;
            font-size: 13px;
            color: #cbd5e1;
        }
        .email-body {
            padding: 28px 24px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #0f3a69;
        }
        .section-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 8px;
        }
        .message-content {
            font-size: 14px;
            line-height: 1.6;
            color: #334155;
            white-space: pre-line;
        }
        .reply-box {
            background-color: #f0f7ff;
            border-left: 4px solid #0f3a69;
            padding: 16px;
            border-radius: 4px;
            margin-bottom: 24px;
        }
        .reply-box .section-title {
            color: #0f3a69;
        }
        .email-footer {
            background-color: #f8fafc;
            padding: 20px 24px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
        }
        .contact-info {
            margin-top: 8px;
            font-weight: 500;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>BADAN NARKOTIKA NASIONAL</h1>
            <p>KOTA JAKARTA TIMUR</p>
        </div>
        <div class="email-body">
            <div class="greeting">Halo, {{ $feedback->name }}</div>
            <p style="font-size: 14px; line-height: 1.6; margin-top: 0; color: #475569;">
                Terima kasih telah menyampaikan kritik dan saran Anda melalui Aplikasi Informasi Bahaya Narkoba BNN Kota Jakarta Timur. Masukan Anda sangat berharga bagi kami dalam meningkatkan kualitas layanan dan sosialisasi pencegahan narkoba.
            </p>

            <div class="section-box">
                <div class="section-title">Pesan / Kritik Anda:</div>
                <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px; color: #1e293b;">
                    Subjek: {{ $feedback->subject }}
                </div>
                <div class="message-content">{{ $feedback->message }}</div>
            </div>

            <div class="reply-box">
                <div class="section-title">Tanggapan Resmi BNN Kota Jakarta Timur:</div>
                <div class="message-content" style="color: #0f172a; font-weight: 500;">
                    {{ $replyMessage }}
                </div>
            </div>

            <p style="font-size: 13px; color: #64748b; line-height: 1.6;">
                Mari bersama kita wujudkan Jakarta Timur yang bersih dari narkoba (Bersinar). Jika ada pertanyaan darurat atau konsultasi rehabilitasi, hubungi Hotline BNN di <strong>184</strong>.
            </p>
        </div>
        <div class="email-footer">
            <div><strong>Badan Narkotika Nasional Kota Jakarta Timur</strong></div>
            <div class="contact-info">Jl. Otista Raya No. 469, Jatinegara, Jakarta Timur | Call Center: 184</div>
            <div style="margin-top: 6px; font-size: 11px; color: #94a3b8;">Email ini dikirim secara otomatis oleh sistem layanan informasi BNN Kota Jakarta Timur.</div>
        </div>
    </div>
</body>
</html>
