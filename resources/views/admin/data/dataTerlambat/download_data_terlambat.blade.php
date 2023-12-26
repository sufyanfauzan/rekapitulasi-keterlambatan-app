<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        .container p,
        table {
            font-size: 12px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content p {
            margin: 0;
        }

        .content span {
            display: inline-block;
            width: 80px;
        }

        table {
            width: 100%;
            /* Set table width to 100% */
            border-collapse: collapse;
            text-align: center;
        }

        tr,
        td {
            border: none;
            padding: 10px;
        }

        td {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <p>SURAT PERNYATAAN</p>
            <p>TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</p>
        </div>
        <br><br>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini :</p>
            <br>
            <p><span>Nis</span>: {{ $student->nis }}</p>
            <p><span>Nama</span>: {{ $student->name }}</p>
            <p><span>Rombel</span>: {{ $student->rombels->rombel }}</p>
            <p><span>Rayon</span>: {{ $student->rayons->rayon }}</p>
        </div>

        <p>
            Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke
            sekolah sebanyak <strong>3 Kali</strong> yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan.
            Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi
            saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.
        </p>
<br>
        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
        <br>
        <center>
            <div class="signature">
                <table>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Bogor, {{ \Carbon\Carbon::now()->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Peserta Didik,</td>
                        <td></td>
                        <td>Orang Tua/Wali Peserta Didik,</td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td>( {{ $student->name }} )</td>
                        <td></td>
                        <td>( ................ )</td>
                    </tr>
                    <tr>
                        <td>Pembimbing Siswa,</td>
                        <td></td>
                        <td>Kesiswaan,</td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br></td>
                    </tr>
                    <tr>
                        <td>( PS {{ $student->rayons->rayon }})</td>
                        <td></td>
                        <td>( ................ )</td>
                    </tr>
                </table>
            </div>
        </center>
    </div>
</body>

</html>
