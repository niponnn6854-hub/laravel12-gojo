<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>About Me</title>
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            font-family: 'Segoe UI', sans-serif;
            color: #e0e0e0;
        }

        .profile-row {
            max-width: 1100px;
            margin: 60px auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .side-images {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .side-images img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .profile-header {
            flex: 1;
            max-width: 700px;
            background: #1e1e1e;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            padding: 40px;
            text-align: center;
        }

        .profile-img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #2a2a2a;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            color: #ffffff;
        }

        .profile-header .text-muted {
            color: #9e9e9e !important;
        }

        .portfolio-section {
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .portfolio-section h2 {
            color: #ffffff;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .portfolio-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
            background: #1e1e1e;
            border: 1px solid #2a2a2a;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            color: #e0e0e0;
            transition: 0.2s;
        }

        .portfolio-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.5);
            background: #262626;
            color: #ffffff;
        }

        .portfolio-card .icon-img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .portfolio-card .label {
            font-weight: 600;
            text-align: center;
        }

        .portfolio-card {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 0;
            overflow: hidden;
            /* ให้รูปโค้งตามมุมการ์ด */
            background: #1e1e1e;
            border: 1px solid #2a2a2a;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            color: #e0e0e0;
            transition: 0.2s;
        }

        .portfolio-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.5);
            background: #262626;
            color: #ffffff;
        }

        .portfolio-card .icon-img {
            width: 100%;
            height: 180px;
            /* ปรับความสูงได้ */
            object-fit: cover;
            /* เต็มช่อง ตัดส่วนเกิน */
            margin-bottom: 0;
            display: block;
        }

        .portfolio-card .label {
            font-weight: 600;
            text-align: center;
            padding: 14px 16px;
        }

        @media (max-width: 900px) {
            .profile-row {
                flex-direction: column;
            }

            .side-images {
                flex-direction: row;
            }
        }

        body {
            background-color: #121212;
            font-family: 'Segoe UI', sans-serif;
            color: #e0e0e0;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            top: 0;
            bottom: 0;
            width: 22vw;
            z-index: -1;
            pointer-events: none;
            background-image:

                repeating-linear-gradient(45deg,
                    rgba(255, 255, 255, 0.04) 0,
                    rgba(255, 255, 255, 0.04) 2px,
                    transparent 2px,
                    transparent 14px),
                /* จุด */
                radial-gradient(rgba(255, 255, 255, 0.10) 1.5px, transparent 1.5px);
            background-size: auto, 22px 22px;
        }

        body::before {
            left: 0;

            -webkit-mask-image: linear-gradient(to right, #000 30%, transparent);
            mask-image: linear-gradient(to right, #000 30%, transparent);
        }

        body::after {
            right: 0;
            -webkit-mask-image: linear-gradient(to left, #000 30%, transparent);
            mask-image: linear-gradient(to left, #000 30%, transparent);
        }

        @media (max-width: 576px) {
            .portfolio-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="profile-row">
        <div class="side-images">
            <img src="{{ asset('assets/img/icons/shadow.webp') }}" alt="">
            <img src="{{ asset('assets/img/icons/doomgay.jpg') }}" alt="">
        </div>

        <div class="profile-header">
            <img src="{{ asset('assets/img/kiriphone.png') }}" alt="รูปโปรไฟล์" class="profile-img">
            <h1 class="h3 mb-1">นิพนธ์ เพ็งคล้าย</h1>
            <p class="text-muted mb-0">รหัสนักศึกษา: 68122420014</p>
        </div>

        <div class="side-images">
            <img src="{{ asset('assets/img/icons/morty.jpg') }}" alt="">
            <img src="{{ asset('assets/img/icons/lokii.webp') }}" alt="">
        </div>
    </div>

    <div class="portfolio-section">
        <h2 class="h5 mb-3 text-center">งานที่เคยทำ</h2>
        <div class="portfolio-grid">
            <a href="/gallery" class="portfolio-card">
                <img src="{{ asset('assets/img/icons/loki.webp') }}" alt="" class="icon-img">
                <span class="label">EP02 Hero avengers</span>
            </a>

            <a href="/active/index" class="portfolio-card">
                <img src="{{ asset('assets/img/icons/pun.jpg') }}" alt="" class="icon-img">
                <span class="label">EP03 Active Bootstrap</span>
            </a>
            <a href="/weights" class="portfolio-card">
                <img src="{{ asset('assets/img/icons/weights.jpg') }}" alt="" class="icon-img">
                <span class="label">EP07 Weight</span>
            </a>
            <a href="/login" class="portfolio-card">
                <img src="{{ asset('assets/img/icons/imax.jpg') }}" alt="" class="icon-img">
                <span class="label">EP08 Auth (Login)</span>
            </a>
        </div>
    </div>

</body>

</html>
