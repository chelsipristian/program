<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Penerimaan Peserta Didik Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #dddddd;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 200px;
            height: auto;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            padding: 10px 0;
        }
    </style>
</head>
<body>

    <h1>Laporan Data Penerimaan Peserta Didik Baru</h1>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Nisn</th>
                <th>Alamat</th>
                <th>Asal_Sekolah</th>
                <th>Tanggal_Lahir</th>
                <th>Jenis_Kelamin</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->alamat }}</td>
                    <td>{{ $student->asal_sekolah }}</td>
                    <td>{{ $student->tanggal_lahir }}</td>
                    <td>{{ $student->jenis_kelamin }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Laporan Mahasiswa dicetak pada: {{ now()->format('d F Y H:i:s') }}
    </div>

</body>
</html>
