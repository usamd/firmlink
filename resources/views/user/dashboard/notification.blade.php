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
                <li class="bg-[#0E4D2D] p-6"><a href="{{ url('/user/dashboard/notification') }}"><i class="fa-solid fa-bell"></i>Notifications</a></li>
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



    <div class="notifications">
		<div class="news">
			<div class="headings">
				<div class="new">New for you</div>
			    <button class="read">Mark all read</button>
			</div>
			<div class="information">
				<div class="data">
					<div class="descrip">
						<div class="newsp"><img src="{{ asset('assest\j2.jpg') }}" alt="Profile Picture" class="newspp"></div>
						<div class="newsd">
							<div class="md">distribution</div>
							<div class="sd">wcjofdo. design .march 4</div>
						</div>
					</div>
				</div>
				<button class="mread"></button>
			</div>
			<div class="pnot">
				<div></div>
				<button class="previous"> << Previous Notifications</button>
			</div>
		</div>
		<div class="shedule">
			<button class="submitbutton">Schedule</button>
			<div class="event">A few upcoming events - <a href="#">see all</a></div>
			<div class="calender"><input type="date" value="select date"></div>
			<div class="notetable">
			    <table>
					<td class="tdt">sun Mar 4</td>
					<td>meeting with client and discuss sbout the matters</td>
			    </table>
			</div>

		</div>

	</div>

</body>
</html>
