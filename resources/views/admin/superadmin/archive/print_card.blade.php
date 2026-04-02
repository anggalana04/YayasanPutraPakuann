<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Siswa – {{ $student->full_name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px;
            min-height: 100vh;
        }

        .print-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn {
            padding: 10px 24px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: opacity 0.15s;
        }

        .btn-primary  { background: #6c5a00; color: #fff; }
        .btn-outline  { background: transparent; border: 2px solid #6c5a00; color: #6c5a00; }
        .btn:hover    { opacity: 0.85; }

        /* The actual card */
        .card {
            width: 86mm;       /* standard ID card width */
            min-height: 54mm;  /* ID card height */
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            overflow: hidden;
            page-break-inside: avoid;
        }

        .card-header {
            background: #1c190d;
            color: #f2cc0d;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
        }

        .card-header-text h1 {
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .card-header-text p {
            font-size: 7px;
            color: rgba(255,255,255,0.6);
            margin-top: 1px;
        }

        .card-body {
            padding: 12px 14px;
            display: flex;
            gap: 12px;
        }

        .card-photo {
            width: 52px;
            height: 64px;
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid #e0e0e0;
            flex-shrink: 0;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            color: #6c5a00;
        }

        .card-info {
            flex: 1;
            min-width: 0;
        }

        .card-info h2 {
            font-size: 11px;
            font-weight: 900;
            color: #1c190d;
            margin-bottom: 6px;
            word-break: break-word;
        }

        .card-field {
            display: flex;
            flex-direction: column;
            margin-bottom: 4px;
        }

        .card-field-label {
            font-size: 7px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #767775;
        }

        .card-field-value {
            font-size: 9px;
            font-weight: 600;
            color: #1c190d;
        }

        .card-footer {
            background: #f5f3e8;
            padding: 7px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-footer .badge {
            font-size: 7px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: #6c5a00;
            color: #f2cc0d;
            padding: 3px 8px;
            border-radius: 999px;
        }

        .card-footer .year {
            font-size: 8px;
            font-weight: 700;
            color: #5a5c5a;
        }

        @media print {
            body {
                background: transparent;
                padding: 0;
            }
            .print-actions { display: none !important; }
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            @page {
                size: 86mm 60mm;
                margin: 3mm;
            }
        }
    </style>
</head>
<body>

    <div class="print-actions">
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak Kartu
        </button>
        <button onclick="window.close()" class="btn btn-outline">
            Tutup
        </button>
    </div>

    <div class="card">
        {{-- Header --}}
        <div class="card-header">
            <img src="{{ asset('images/logo-yayasan.png') }}" alt="Logo">
            <div class="card-header-text">
                <h1>{{ $student->school->name }}</h1>
                <p>Kartu Identitas Siswa</p>
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body">
            {{-- Photo --}}
            @php $photoUrl = $student->photoUrl; @endphp
            @if($photoUrl)
                <img src="{{ $photoUrl }}" alt="{{ $student->full_name }}" class="card-photo">
            @else
                <div class="card-photo">{{ $student->initial }}</div>
            @endif

            {{-- Info --}}
            <div class="card-info">
                <h2>{{ $student->full_name }}</h2>

                @if($student->nis)
                    <div class="card-field">
                        <span class="card-field-label">NIS</span>
                        <span class="card-field-value">{{ $student->nis }}</span>
                    </div>
                @endif

                @if($student->nisn)
                    <div class="card-field">
                        <span class="card-field-label">NISN</span>
                        <span class="card-field-value">{{ $student->nisn }}</span>
                    </div>
                @endif

                @if($student->class_label)
                    <div class="card-field">
                        <span class="card-field-label">Kelas / Jurusan</span>
                        <span class="card-field-value">{{ $student->class_label }}</span>
                    </div>
                @endif

                @if($student->date_of_birth)
                    <div class="card-field">
                        <span class="card-field-label">Tanggal Lahir</span>
                        <span class="card-field-value">{{ $student->date_of_birth->format('d M Y') }}</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Footer --}}
        <div class="card-footer">
            <span class="badge">{{ \App\Models\Student::getStatusLabel($student->enrollment_status) }}</span>
            <span class="year">T.A. {{ $student->academic_year_entry }}</span>
        </div>
    </div>

</body>
</html>
