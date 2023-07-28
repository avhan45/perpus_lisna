<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
    body{
        color:black;
    }
        table {
            border-spacing: 0;
            width: 100%;
        }
        th {
            background: #f2f2f2; /* Changed the background color to light gray */
            border-left: 1px solid rgba(0, 0, 0, 0.2);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            color: #000; /* Changed the text color to a darker shade */
            padding: 8px;
            text-align: left;
            text-transform: uppercase;
        }
        th:first-child {
            border-top-left-radius: 4px;
            border-left: 0;
        }
        th:last-child {
            border-top-right-radius: 4px;
            border-right: 0;
        }
        td {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 8px;
        }
        td:first-child {
            border-left: 1px solid #000;
        }
        img {
            width: 40px;
            height: 40px;
            border-radius: 100%;
        }
        .center {
            text-align: center;
        }
    </style>
    <!-- Add appropriate links for CSS and JavaScript libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title>Laporan Data Buku</title>
</head>
<body>
<h1 class="center">LAPORAN DATA BUKU</h1>
<table id="pseudo-demo">
    <thead>
        <tr>
            <th>Judul</th>
            <th>ISBN</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Rak</th>
        </tr>
    </thead>
    <tbody>
        <!-- Table body goes here -->
        @foreach($datas as $data)
        <tr>
            <td class="py-1">{{$data->judul}}</td>
            <td>{{$data->isbn}}</td>
            <td>{{$data->pengarang}}</td>
            <td>{{$data->penerbit}}</td>
            <td>{{$data->tahun_terbit}}</td>
            <td>{{$data->jumlah_buku}}</td>
            <td>{{$data->lokasi}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Add appropriate links for JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Initialize DataTable using the correct table ID
        $('#pseudo-demo').DataTable({
            "iDisplayLength": 50
        });
    });
</script>
</body>
</html>
