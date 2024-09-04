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
                <li><a href="{{ url('/user/dashboard/dashboard') }}"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href="{{ url('/user/dashboard/explore') }}"><i class="fa-solid fa-magnifying-glass"></i>Explore</a></li>
                <li><a href="{{ url('/user/dashboard/notification') }}"><i class="fa-solid fa-bell"></i>Notifications</a></li>
                <li><a href="{{ url('/user/dashboard/newsfeed') }}"><i class="fa-solid fa-newspaper"></i>Newsfeed</a></li>
                <li class="bg-[#0E4D2D] p-6"><a href="{{ url('/user/dashboard/profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
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
                    <li><a href="#">Create a post</a></li>
                </ul>
            </div>

        </div>
    </div>





    <div class="navbarp">
		<nav>
			<ul>
				<li><a href="#"></a>Account</li>
				<li><a href="#"></a>Reposts</li>
				<li><a href="#"></a>Settings</li>
				<li><a href="#"></a>Help & Support</li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
             </a></li>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

			</ul>

		</nav>
	</div>

<div class="pro">
		<div class="prop">
			<div class="propp"><img src="{{ asset('assest/'. $users->avatar) }}" alt="Profile Picture" class="newspp"></div>
		</div>
	<div class="prod">
		<div class="proname">{{ $users->name}}</div>
		<div class="prodetail1">{{ $users->email}}</div>
		<div class="prodetail2">I'm a full stack developer</div>

		<div class="protable">
			<table>
				<tr>
                    <th>10</th>
				    <th>1000</th>
				    <th>500</th>
                </tr>
                <tr>
                    <th>Shots</th>
                    <th>Followers</th>
                    <th>Following</th>
                </tr>
			</table>
		</div>
	</div>
</div>

		<div class="probuttons">
			<div><button class="submitbutton">Follow</button></div>
			<div><a href="{{ route('chat.index') }}"><button class="submitbutton">Messages</button></a></div>

		</div>

</body>
</html>
