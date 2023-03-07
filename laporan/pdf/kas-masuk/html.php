<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN KAS MASUK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
        }

        body {
            padding: 30px;
        }

        .heading {
            margin-top: 10px;
            padding-bottom: 5px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 18px;
        }

        h2 {
            font-size: 14px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        hr {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .right {
            text-align: right;
            padding-right: 10px;
        }

        .center {
            text-align: center;
        }

        /* th,
        td {
            text-align: left;
            padding: 8px;
        } */

        th {
            background-color: #4CAF50;
            color: white;
            border: 1px grey solid;
        }

        td {
            border: 1px grey solid;
        }

        tbody {
            font-size: 10pt;
        }

        .footer {
            width: 100%;
            /* text-align: center; */
            position: absolute;
            bottom: 30px;
            right: 30px;
            left: 30px;
            font-size: 8pt;
        }

        .pagenum:before {
            content: counter(page);
        }

        img {
            position: absolute;
            top: 27px;
            left: 160px;
        }
    </style>
</head>

<body>
    <img width="70" src="data:image/jpeg;base64,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" alt="" srcset="">
    <h1 class="heading">GEREJA PANTEKOSTA MALUKU</h1>
    <p class="subtitle">JEMAAT BAGUALA - PASSO</p>
    <hr>
    <h2>LAPORAN KAS MASUK PERIODE {{mulai}} s/d {{selesai}}</h2>
    <table class="table table-bordered table-xs">
        <thead>
            <tr>
                <th>NO</th>
                <th>NO ACC</th>
                <th>TANGGAL</th>
                <th>KODE KAS</th>
                <th>KETERANGAN</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            {{table_rows}}
        </tbody>
    </table>
    <div class="footer">
        GEPAM BAGUALA PASSO - LAPORAN KAS MASUK <span style="float:right; margin-right:60px">Hal. <span class="pagenum"></span></span>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>