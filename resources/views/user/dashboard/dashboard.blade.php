<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>biznest</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <img src="{{ asset('assest\Biznest.png') }}" alt="Biznest Logo">

            <ul>
                <li class="bg-[#0E4D2D] p-6"><a href="{{ url('/user/dashboard/dashboard') }}"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href="{{ url('/user/dashboard/explore') }}"><i class="fa-solid fa-magnifying-glass"></i>Explore</a></li>
                <li><a href="{{ url('/user/dashboard/notification') }}"><i class="fa-solid fa-bell"></i>Notifications</a></li>
                <li><a href="{{ url('/user/dashboard/newsfeed') }}"><i class="fa-solid fa-newspaper"></i>Newsfeed</a></li>
                <li><a href="{{ url('/user/dashboard/profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
            </ul>

            <div class="pid">
                <div class="id">
                    <img src="{{ asset('assest/'. $users->avatar) }}" alt="Profile Picture" class="sidebar-profile-picture">
                </div>
                <div class="pdetails">
                    <div class="profilename">{{ $users->name}}</div>
                    <div class="pmail">{{ $users->email}}</div>
                </div>
            </div>

            <div class="create">
                <ul>
                    <li><a href="#"><button>Create a post</button></a></li>
                    <li><a href="/">HomePage</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="profiles">
        <div class="profile"><br>
            <div class="profile-picture-container">
                <img src="{{ asset('assest/'. $users->avatar) }}" alt="Profile Picture" class="profile-picture">
            </div>

            <div class="profile-details">Hello Mr</div>
            <div class="text">{{ $users->name}}</div>
            <button class="submitbutton">Analysis</button>
        </div>

        <div class="group2">
            <button class="submitbutton">Contact us</button><br>
            <button class="submitbutton">Settings</button>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <button class="submitbutton">Logout</button>
             </a></li>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="hometable">
        <table style="width:150%;">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Location</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->location }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
