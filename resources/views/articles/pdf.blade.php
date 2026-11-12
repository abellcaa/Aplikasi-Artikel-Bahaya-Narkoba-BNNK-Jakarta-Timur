<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    <style>
        @page { margin: 2.2cm 2cm; }
        body { color: #1f2937; font-family: DejaVu Sans, sans-serif; font-size: 11pt; line-height: 1.65; }
        .brand { color: #0c3866; font-size: 9pt; font-weight: bold; margin-bottom: 24px; }
        .category { color: #0c3866; font-size: 9pt; font-weight: bold; text-transform: uppercase; }
        h1 { color: #111827; font-size: 22pt; line-height: 1.25; margin: 10px 0 14px; }
        .meta { border-bottom: 1px solid #d1d5db; color: #6b7280; font-size: 9pt; padding-bottom: 14px; }
        .summary { background: #f3f6f9; border-left: 4px solid #0c3866; margin: 22px 0; padding: 12px 16px; }
        .summary-label { color: #0c3866; font-size: 9pt; font-weight: bold; margin-bottom: 5px; }
        .content { white-space: pre-wrap; }
        .footer { border-top: 1px solid #d1d5db; color: #6b7280; font-size: 8pt; margin-top: 28px; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="brand">BNN KOTA JAKARTA TIMUR</div>
    <div class="category">{{ $article->category->name }}</div>
    <h1>{{ $article->title }}</h1>
    <div class="meta">
        Ditulis oleh {{ $article->author->name ?? 'Tim Edukasi BNN' }}
        &bull; {{ $article->created_at->translatedFormat('d F Y') }}
        &bull; {{ $article->reading_time }} menit membaca
    </div>
    <div class="summary">
        <div class="summary-label">Ringkasan Materi</div>
        {{ $article->summary }}
    </div>
    <div class="content">{{ $article->content }}</div>
    <div class="footer">Materi edukasi BNN Kota Jakarta Timur. Hotline BNN: 184.</div>
</body>
</html>
