<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Banking Software</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            color: white;
        }

        .navbar img {
            height: 40px;
            width: auto;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .hero {
            text-align: center;
            background-color: #f4f4f4;
            padding: 50px 20px;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
            background-color: #eaeaea;
        }

        .feature {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            padding: 15px;
        }

        .feature img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .contact {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .contact h2 {
            margin-bottom: 15px;
        }

        .contact p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #222;
            color: white;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <img src="{{ asset('assetsDashboard/img/logo.png') }}" alt="Logo">
        <div>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

    <section class="hero">
        <h1>Welcome to Advanced Banking Software</h1>
        <p>Manage your cooperative banking operations seamlessly with our advanced features.</p>
    </section>

    <section id="features" class="features">
        <div class="feature">
            <img src="https://i.pinimg.com/736x/04/2f/3c/042f3cbc27a2c35bf545db58c95bbf0a.jpg" alt="Feature 1">
            <h3>Feature 1</h3>
            <p>Efficient loan management for all member types.</p>
        </div>
        <div class="feature">
            <img src="https://i.pinimg.com/736x/95/57/f4/9557f47dc53eb83fbcdb0ed31769c9a5.jpg" alt="Feature 2">
            <h3>Feature 2</h3>
            <p>Comprehensive reporting and analytics.</p>
        </div>
        <div class="feature">
            <img src="https://i.pinimg.com/736x/41/2e/a7/412ea792b6963690a4a9dce67b73f216.jpg" alt="Feature 3">
            <h3>Feature 3</h3>
            <p>Secure transactions and member management.</p>
        </div>
    </section>

    <section id="contact" class="contact">
        <h2>Contact Us</h2>
        <p>Email: support@nidhisoftware.com</p>
        <p>Phone: +1-234-567-890</p>
        <p>Address: 123 Nidhi Lane, FinTech City</p>
    </section>

    <footer class="footer">
        <p>&copy; 2024 Nidhi Banking Software. All rights reserved.</p>
    </footer>
</body>

</html>