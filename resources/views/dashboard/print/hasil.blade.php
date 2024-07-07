<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hasil Pemilihan Umum Ketua OSIS & MPK SMKN 2 Sumedang Tahun Periode
            {{ cache('settings')['voting_angkatan']['value'] }}</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            * {
                font-family: sans-serif !important;
            }

            body {
                font-family: sans-serif !important;
                margin: 0;
                padding: 0;
            }


            .document {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
            }

            .header {
                text-align: center;
            }

            .title {
                margin-bottom: 20px;
            }

            .subtitles {
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .content {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            thead th,
            td {
                padding: 5px;
                text-align: left;
            }

            thead th {
                background-color: #f2f2f2;
            }

            .text-center {
                text-align: center;
                width: 64px;
            }

            .kop-surat {
                font-size: 10pt;
                border-collapse: collapse;
                margin: auto;
            }

            .kop-surat tr th:nth-child(1) {
                font-weight: normal !important;
                padding-right: 18px;
                padding-left: 18px;
            }

            .kop-surat tr th img {
                /* padding: 0px 16px;
                padding-left: 28px; */
                width: 72px
            }

            /*
            .kop-surat tr th:first-child img {
                padding-right: 28px;
                padding-left: 0px;
            } */

            .kop-surat tr th.bold {
                font-weight: bold !important;
                font-size: 13pt !important;
            }
        </style>
    </head>

    <body>

        <section class="document">
            <table class="kop-surat">
                <tr>
                    <th rowspan="6"><img src="img/gridas.png"></th>
                    <th>DINAS PENDIDIKAN</th>
                    <th rowspan="6"><img src="img/rpl.png"></th>
                </tr>
                <tr>
                    <th>CABANG DINAS PENDIDIKAN WILAYAH VIII</th>
                </tr>
                <tr>
                    <th class="bold">SMK NEGERI 2 SUMEDANG</th>
                </tr>
                <tr>
                    <th>Jalan Arief Rakhman Hakim No. 59 Telp. 0261-201531, Fax. 0261-210097</th>
                </tr>
                <tr>
                    <th><a href="">http://www.smkn2sumedang.sch.id</a> - email: <a href="">
                            smkn2sumedang@yahoo.com
                        </a></th>
                </tr>
                <tr>
                    <th>KABUPATEN SUMEDANG 45323</th>
                </tr>
            </table>

            <hr>
            <div class="content">
                <center class="osis-table">
                    <h2 class="subtitles">OSIS</h2>
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-center">No Urut</th>
                                <th>Sebagai</th>
                                <th class="text-center">Jumlah Vote</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $os = 0;
                            @endphp
                            @foreach ($osis as $o)
                                <tr>
                                    <td>{{ $o->name }}</td>
                                    <td class="text-center">{{ $o->nomor_urut }}</td>
                                    <td>{{ $new_role[$os] ?? '-' }}</td>
                                    <td class="text-center">{{ $o->vote_count }}</td>
                                </tr>
                                @php
                                    $os++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </center>
                <center class="mpk-table">
                    <h2 class="subtitles">MPK</h2>
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-center">No Urut</th>
                                <th>Sebagai</th>
                                <th class="text-center">Jumlah Vote</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $mp = 0;
                            @endphp
                            @foreach ($mpk as $m)
                                <tr>
                                    <td>{{ $m->name }}
                                    <td class="text-center">{{ $m->nomor_urut }}</td>
                                    <td>{{ $new_role[$mp] ?? '-' }}</td>
                                    <td class="text-center">{{ $m->vote_count }}</td>
                                </tr>
                                @php
                                    $mp++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </center>
            </div>
        </section>
    </body>

</html>
