<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .scan-container {
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 20px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #reader {
            width: 100%;
            height: 300px;
            border: 2px dashed #333;
            margin-bottom: 15px;
        }
        .manual-input {
            margin-top: 15px;
        }
        .manual-input input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .manual-input button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #00BCD4;
            color: #FFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .manual-input button:hover {
            background-color: #0097A7;
        }
    </style>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div class="scan-container">
        <h1>SCAN HERE</h1>
        <div id="reader"></div>
        <p>Scan kode batang buku untuk memproses peminjaman</p>
        
        <div class="manual-input">
            <input type="text" id="manual-code" placeholder="Masukkan kode batang secara manual">
            <button onclick="submitManualCode()">Submit</button>
        </div>
    </div>

    <script>
    function onScanSuccess(decodedText, decodedResult) {
        window.location.href = `prosespinjam.php?code=${encodeURIComponent(decodedText)}`;
    }

    function submitManualCode() {
        const manualCode = document.getElementById('manual-code').value;
        if (manualCode) {
            window.location.href = `prosespinjam.php?code=${encodeURIComponent(manualCode)}`;
        } else {
            alert("Masukkan kode batang terlebih dahulu.");
        }
    }

    const html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: { width: 250, height: 250 } },
        onScanSuccess,
        (error) => console.warn(`Kode batang gagal dipindai: ${error}`)
    ).catch(err => {
        console.error(`Error in initializing the scanner: ${err}`);
    });
    </script>
</body>
</html>
