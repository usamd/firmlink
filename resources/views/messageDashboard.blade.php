<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BizNest Messenger Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f8fafc;
      margin: 0;
    }
    .navbar {
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      padding: 0.5rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .nav-logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .logo {
      width: 40px;
      height: 40px;
    }
    .logo-text {
      font-weight: 700;
      font-size: 1.3rem;
      color: #1d3557;
    }
    .nav-menu a {
      margin: 0 1rem;
      color: #1d3557;
      text-decoration: none;
      font-weight: 500;
    }
    .nav-buttons .btn-secondary, .nav-buttons .btn-primary {
      margin-left: 1rem;
      padding: 0.5rem 1.2rem;
      border-radius: 6px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-secondary {
      background: #fff;
      color: #1d3557;
      border: 1px solid #1d3557;
    }
    .btn-primary {
      background: linear-gradient(90deg, #457b9d 0%, #a8dadc 100%);
      color: #fff;
      border: none;
    }
    .dashboard-container {
      display: flex;
      gap: 2rem;
      padding: 2rem;
      max-width: 1200px;
      margin: 2rem auto;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    }
    .left, .middle, .right {
      background: #f1f5f9;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }
    .left {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 220px;
    }
    .centered img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
      margin-bottom: 1rem;
    }
    .centered h2 {
      margin: 0.5rem 0 0.2rem 0;
      font-size: 1.2rem;
      font-weight: 600;
      color: #1d3557;
    }
    .centered p {
      color: #457b9d;
      font-size: 0.95rem;
      margin-bottom: 1rem;
    }
    .centered button {
      background: linear-gradient(90deg, #457b9d 0%, #a8dadc 100%);
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 0.5rem 1rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 0.5rem;
    }
    .middle {
      flex: 2;
      margin: 0 1rem;
    }
    .middle h2 {
      font-size: 1.3rem;
      color: #1d3557;
      margin-bottom: 1rem;
    }
    .right {
      flex: 3;
      display: flex;
      flex-direction: column;
      min-width: 350px;
    }
    .header h2 {
      font-size: 1.1rem;
      color: #1d3557;
      margin-bottom: 0.5rem;
    }
    .message-history {
      flex: 1;
      background: #fff;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.03);
      min-height: 200px;
      overflow-y: auto;
    }
    .message-input {
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }
    #message-text {
      flex: 1;
      padding: 0.6rem;
      border-radius: 6px;
      border: 1px solid #a8dadc;
      font-size: 1rem;
    }
    #send-button {
      background: linear-gradient(90deg, #457b9d 0%, #a8dadc 100%);
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 0.6rem 1.2rem;
      font-weight: 600;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar">
    <div class="nav-logo">
      <img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
      <span class="logo-text">BizNest</span>
    </div>
    <div class="nav-menu">
      <a href="/">Home</a>
      <a href="#categories">Categories</a>
      <a href="#trending">Trending</a>
      <a href="#about">About Us</a>
    </div>
    <div class="nav-buttons">
      <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
      <a href="{{ route('register_user') }}" class="btn-primary">Sign Up</a>
    </div>
  </nav>

  <!-- Dashboard Layout -->
  <div class="dashboard-container">
    <div class="left">
      <div class="centered">
        <img src="{{ asset('assest/avatar.png') }}" alt="Avatar men">
        <h2>Jane Flex</h2>
        <p>Business Owner</p>
        <a href="#"><button>Settings</button></a>
      </div>
    </div>

    <div class="middle">
      <h2><i class="fas fa-comments"></i> Messages</h2>
      <!-- You can add a list of conversations or contacts here -->
    </div>

    <div class="right">
      <div class="header">
        <h2><i class="fas fa-user"></i> User Name</h2>
      </div>
      <div class="message-history">
        <!-- Messages will appear here -->
      </div>
      <div class="message-input">
        <input type="text" id="message-text" placeholder="Type your message">
        <button id="send-button"><i class="fas fa-paper-plane"></i> Send</button>
      </div>
    </div>
  </div>

</body>
</html>
