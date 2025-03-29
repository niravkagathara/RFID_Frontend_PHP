<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendEase | Modern Attendance Management</title>
    <style>
        :root {
            --primary: #3A86FF;
            --secondary: #8338EC;
            --accent: #FF006E;
            --light: #F8F9FA;
            --dark: #212529;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        nav a:hover {
            background-color: rgba(255,255,255,0.2);
        }
        
        .hero {
            padding: 4rem 2rem;
            text-align: center;
            background-color: white;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
            color: #555;
        }
        
        .cta-button {
            display: inline-block;
            background-color: var(--accent);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(255,0,110,0.3);
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255,0,110,0.4);
        }
        
        .features {
            padding: 4rem 2rem;
            background-color: var(--light);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--dark);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .feature-card h3 {
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .demo-image {
            max-width: 800px;
            margin: 2rem auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .demo-image img {
            width: 100%;
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <div class="logo-icon">✓</div>
            <span>AttendEase</span>
        </div>
        <nav>
            <ul>
                <li><a href="#">Features</a></li>
                <li><a href="#">Solutions</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="hero">
        <h1>Modern Attendance Management Made Simple using IoT</h1>
        <p>AttendEase helps organizations of all sizes track attendance effortlessly with our intuitive, cloud-based solution. Save time and reduce errors with automated attendance tracking and IoT RFID Attendance System.</p>
        <a href="#" class="cta-button">Get Started for Free</a>
        
        <div class="demo-image">
            <!-- Add your image here -->
            <img src="./Dashboard.png" alt="Dashboard Preview" style="max-width: 100%; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>
    </section>
    
    <section class="features">
        <h2 class="section-title">Key Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">⏱️</div>
                <h3>Real-time Tracking</h3>
                <p>Monitor attendance as it happens with our live tracking system that updates instantly across all devices.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Comprehensive Reports</h3>
                <p>Generate detailed attendance reports with just a few clicks for any time period or department.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Mobile Friendly</h3>
                <p>Mark attendance from anywhere using our responsive web app or dedicated mobile applications.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Secure Data</h3>
                <p>Enterprise-grade security protects your attendance data with encryption and regular backups.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔄</div>
                <h3>Integrations</h3>
                <p>Connect with your existing HR systems and tools through our API and ready-made integrations.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🤖</div>
                <h3>Automated Alerts</h3>
                <p>Receive notifications for late arrivals, absences, or unusual patterns automatically.</p>
            </div>
        </div>
    </section>
    
    <footer>
        <p>© 2023 AttendEase. All rights reserved.</p>
        <p>Designed to simplify your attendance management workflow.</p>
    </footer>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    Bootstrap 5 CSS
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    Custom CSS
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            background-color: var(--secondary-color);
            min-height: 100vh;
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 5px;
            border-radius: 5px;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            font-size: 2rem;
            color: var(--primary-color);
        }
        
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--secondary-color);
        }
        
        .stat-title {
            color: #6c757d;
            font-size: 1rem;
        }
        
        .navbar-brand {
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table th {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .badge-present {
            background-color: #2ecc71;
        }
        
        .badge-absent {
            background-color: #e74c3c;
        }
        
        .badge-late {
            background-color: #f39c12;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        Sidebar
        <nav id="sidebar" class="sidebar col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <h4>Attendance System</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="attendance.php">
                            <i class="fas fa-clipboard-check"></i> Take Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="students.php">
                            <i class="fas fa-users"></i> Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">
                            <i class="fas fa-chart-bar"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">
                            <i class="fas fa-info-circle"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            <i class="fas fa-envelope"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        Main Content
        <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
            Top Navigation
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <span class="nav-link">Welcome, Admin</span>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i> Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            Page Content
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Today</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Week</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Month</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-download me-1"></i> Export
                        </button>
                    </div>
                </div>

                Stats Cards
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="card-icon mb-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3 class="stat-number">245</h3>
                                <p class="stat-title">Total Students</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="card-icon mb-3">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h3 class="stat-number">92%</h3>
                                <p class="stat-title">Today's Attendance</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="card-icon mb-3">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <h3 class="stat-number">225</h3>
                                <p class="stat-title">Present Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="card-icon mb-3">
                                    <i class="fas fa-user-times"></i>
                                </div>
                                <h3 class="stat-number">20</h3>
                                <p class="stat-title">Absent Today</p>
                            </div>
                        </div>
                    </div>
                </div>

                Recent Attendance
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Attendance Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>S001</td>
                                        <td>John Doe</td>
                                        <td>2023-06-15</td>
                                        <td><span class="badge bg-success badge-present">Present</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>S002</td>
                                        <td>Jane Smith</td>
                                        <td>2023-06-15</td>
                                        <td><span class="badge bg-success badge-present">Present</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>S003</td>
                                        <td>Robert Johnson</td>
                                        <td>2023-06-15</td>
                                        <td><span class="badge bg-danger badge-absent">Absent</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>S004</td>
                                        <td>Emily Davis</td>
                                        <td>2023-06-15</td>
                                        <td><span class="badge bg-warning badge-late">Late</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    Bootstrap JS Bundle with Popper
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    Custom JS
    <script>
        // Activate tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</body>
</html> -->