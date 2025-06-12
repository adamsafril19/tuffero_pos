<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | Tuffero_POS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #8C521C;
            --primary-light: #A56A2F;
            --secondary: #D9C6A7;
            --accent: #BF8B5E;
            --light: #F4E9D8;
            --dark: #3C2A1E;
            --success: #5D8C5B;
            --danger: #d9534f;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--light) 0%, #f0e3d1 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="20" cy="20" r="3" fill="%23BF8B5E" opacity="0.2"/><circle cx="50" cy="50" r="4" fill="%23BF8B5E" opacity="0.2"/><circle cx="80" cy="80" r="3" fill="%23BF8B5E" opacity="0.2"/><circle cx="30" cy="70" r="2" fill="%23BF8B5E" opacity="0.2"/><circle cx="70" cy="30" r="2" fill="%23BF8B5E" opacity="0.2"/></svg>');
            background-size: 150px;
            opacity: 0.3;
            z-index: -1;
        }

        .verification-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            min-height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(60, 42, 30, 0.2);
            background: white;
        }

        .banner-side {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .banner-side::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .banner-side::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .banner-content {
            position: relative;
            z-index: 2;
            max-width: 400px;
        }

        .logo {
            width: 180px;
            margin-bottom: 30px;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.2));
        }

        .banner-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .banner-subtitle {
            font-size: 1.2rem;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        .cake-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }

        .cake-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cake-icon i {
            color: white;
        }

        .quote {
            font-style: italic;
            margin-top: 20px;
            font-size: 1rem;
            opacity: 0.85;
        }

        .content-side {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
            position: relative;
        }

        .verification-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(140, 82, 28, 0.1);
            border: 1px solid var(--secondary);
        }

        .verification-icon {
            width: 100px;
            height: 100px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: var(--primary);
            font-size: 45px;
            border: 3px solid var(--secondary);
        }

        .verification-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 2.2rem;
            margin-bottom: 15px;
        }

        .verification-text {
            color: var(--dark);
            font-size: 1.1rem;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .alert {
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 10px;
            font-size: 1rem;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(140, 82, 28, 0.3);
        }

        .btn-icon {
            margin-right: 10px;
            font-size: 18px;
        }

        .developer {
            text-align: center;
            margin-top: 30px;
            color: var(--accent);
            font-size: 0.9rem;
        }

        .developer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        .developer a:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }

        /* Floating cake decorations */
        .floating-cake {
            position: absolute;
            z-index: 1;
            opacity: 0.8;
            animation: float 6s infinite ease-in-out;
        }

        .cake-1 {
            top: 10%;
            left: 5%;
            width: 60px;
            animation-delay: 0s;
        }

        .cake-2 {
            top: 25%;
            right: 8%;
            width: 45px;
            animation-delay: 1s;
        }

        .cake-3 {
            bottom: 15%;
            left: 10%;
            width: 50px;
            animation-delay: 2s;
        }

        .cake-4 {
            bottom: 30%;
            right: 5%;
            width: 55px;
            animation-delay: 3s;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .verification-container {
                flex-direction: column;
                min-height: auto;
            }

            .banner-side {
                padding: 30px 20px;
            }

            .content-side {
                padding: 30px 25px;
            }

            .banner-title {
                font-size: 2rem;
            }

            .verification-title {
                font-size: 1.8rem;
            }

            .cake-icons {
                margin: 20px 0;
            }

            .cake-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .floating-cake {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Floating cake decorations -->
    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='30' r='25' fill='%23A56A2F'/><circle cx='30' cy='60' r='15' fill='%23BF8B5E'/><circle cx='70' cy='60' r='15' fill='%23BF8B5E'/><rect x='20' y='75' width='60' height='15' rx='5' fill='%238C521C'/></svg>" class="floating-cake cake-1" alt="Nastar">
    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect x='20' y='25' width='60' height='45' rx='10' fill='%23D9C6A7'/><rect x='15' y='70' width='70' height='15' rx='5' fill='%238C521C'/><circle cx='50' cy='35' r='8' fill='%23BF8B5E'/><circle cx='35' cy='45' r='8' fill='%23BF8B5E'/><circle cx='65' cy='45' r='8' fill='%23BF8B5E'/></svg>" class="floating-cake cake-2" alt="Brownies">
    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='40' r='30' fill='%23BF8B5E'/><circle cx='35' cy='30' r='8' fill='%23F4E9D8'/><circle cx='50' cy='25' r='8' fill='%23F4E9D8'/><circle cx='65' cy='30' r='8' fill='%23F4E9D8'/><rect x='30' y='70' width='40' height='15' rx='5' fill='%238C521C'/></svg>" class="floating-cake cake-3" alt="Cake">
    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect x='25' y='25' width='50' height='40' rx='10' fill='%23D9C6A7'/><rect x='20' y='65' width='60' height='15' rx='5' fill='%238C521C'/><circle cx='35' cy='35' r='5' fill='%23BF8B5E'/><circle cx='50' cy='40' r='5' fill='%23BF8B5E'/><circle cx='65' cy='35' r='5' fill='%23BF8B5E'/></svg>" class="floating-cake cake-4" alt="Pastry">

    <div class="verification-container">
        <div class="banner-side">
            <div class="banner-content">
                <img src="../images/logo-dark.png" class="logo" alt="Tuffero POS">
                <h1 class="banner-title">Verifikasi Email</h1>
                <p class="banner-subtitle">Langkah penting untuk mengakses sistem POS Anda</p>

                <div class="cake-icons">
                    <div class="cake-icon">
                        <i class="fas fa-cookie"></i>
                    </div>
                    <div class="cake-icon">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="cake-icon">
                        <i class="fas fa-cheese"></i>
                    </div>
                </div>

                <p class="quote">"Sama seperti resep kue yang sempurna, verifikasi email memastikan semuanya berjalan dengan baik"</p>
            </div>
        </div>

        <div class="content-side">
            <div class="verification-card">
                <div class="verification-icon">
                    <i class="fas fa-envelope"></i>
                </div>

                <h2 class="verification-title">Verifikasi Alamat Email Anda</h2>

                <!-- Success alert -->
                <div id="resent-alert" class="alert alert-success" role="alert" style="display: none;">
                    Tautan verifikasi baru telah dikirim ke email Anda
                </div>

                <p class="verification-text">
                    Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.
                    Jika Anda tidak menerima email, klik tombol di bawah untuk meminta yang baru.
                </p>

                <a href="#" class="btn btn-primary" id="resend-btn">
                    <i class="fas fa-paper-plane btn-icon"></i>
                    Kirim Ulang Email Verifikasi
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resendBtn = document.getElementById('resend-btn');
            const alertElement = document.getElementById('resent-alert');

            // Check if we should show the success alert
            const showResentAlert = false; // Change to true to simulate success

            if (showResentAlert) {
                alertElement.style.display = 'block';
            }

            resendBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Show loading effect
                const originalText = resendBtn.innerHTML;
                resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                resendBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Show success alert
                    alertElement.style.display = 'block';
                    alertElement.textContent = 'Tautan verifikasi baru telah dikirim ke email Anda';

                    // Reset button
                    setTimeout(() => {
                        resendBtn.innerHTML = originalText;
                        resendBtn.disabled = false;
                    }, 2000);
                }, 1500);
            });
        });
    </script>
</body>
</html>
