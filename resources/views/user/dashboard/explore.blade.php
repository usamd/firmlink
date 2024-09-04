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
                <li class="bg-[#0E4D2D] p-6"><a href="{{ url('/user/dashboard/explore') }}"><i class="fa-solid fa-magnifying-glass"></i>Explore</a></li>
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
                    <li><a href="#">Create a post</a></li>
                </ul>
            </div>

        </div>
    </div>



    <div class="search">
		<input type="text"  placeholder="Search">
		<button><i class="fa-solid fa-magnifying-glass"></i></button>

		<div class="coin1"><button>Ethereum</button></div>
		<div class="coin2"><button>Bitcoin</button></div>
		<div class="coin3"><button>Solana</button></div>
    </div>



<div class="explore-table">
    <table style="width:100% ">
        <tr>
        	<th>Item(Interacted with)</th>
    	    <th>Price(ETH)</th>
    	    <th>Quantity</th>
    	    <th>To</th>
    	    <th>Timestamp(UTC)</th>
    	</tr>
    </table>
</div>


</body>
</html>
