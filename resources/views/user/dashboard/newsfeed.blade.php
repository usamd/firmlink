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
                <li class="bg-[#0E4D2D] p-6"><a href="{{ url('/user/dashboard/newsfeed') }}"><i class="fa-solid fa-newspaper"></i>Newsfeed</a></li>
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





    <div class="newsfeed">
		<div class="wall">
			<div class="msearch">
				<input type="text"  placeholder="Search">
				<button class="sb"><i class="fa-solid fa-magnifying-glass"></i></button>

			</div>
			<div class="navbar">
				<nav>
					<ul>
						<li><a href="#"></a>Scrol</li>
						<li><a href="#"></a>Recent</li>
						<li><a href="#"></a>Photos</li>
						<li><a href="#"></a>Signature</li>
						<li><a href="#"></a>Shared</li>
						<li><a href="#"></a>File request</li>
						<li><a href="#"></a>Deleted files</li>
					</ul>
				</nav>
			</div>
			<div class="related">
				<div class="relatedN">
					<div class="descrip">
						<div class="newsp"><img src="{{ asset('assest\Biznest.png') }}" alt="Profile Picture" class="newspp"></div>
						<div class="newsd">
							<div class="md">Amozon</div>
							<div class="sd">Sponsered</div>
						</div>
					</div>
				</div>
				<div class="rtext">this is to inform that it is so many sales acording to this site</div>
				<div class="ad"></div>
			</div>
		</div>
		<div class="extra">
			<div class="access">Only you have access</div>
			<div class="see">Who can see my tags?</div>
			<div class="addt">Add Tags</div>
			<div class="addtags">
			     <input type="text" placeholder="Add a tag">
			 </div>
			<div class="adddetails">
				<textarea name="detail" placeholder="Add a few details here"></textarea>
			</div>
		</div>
	</div>

</body>
</html>
