<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{asset('assest/Biz.png')}}" type="image/x-icon">
	<title>BizNest Messenger</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	@vite(['resources/css/app.css','resources/js/app.js'])
	
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', sans-serif;
			background: linear-gradient(135deg, #1a2f1a 0%, #0d4f0d 50%, #1a2f1a 100%);
			min-height: 100vh;
			color: white;
			overflow-x: hidden;
		}

		.chat-container {
			display: flex;
			height: 100vh;
			max-width: 1400px;
			margin: 0 auto;
			padding: 20px;
			gap: 20px;
		}

		/* Sidebar Styles */
		.chat-sidebar {
			width: 350px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 20px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			padding: 20px;
			display: flex;
			flex-direction: column;
			position: relative;
			overflow: hidden;
		}

		.chat-sidebar::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 2px;
			background: linear-gradient(90deg, transparent, #7fb069, transparent);
			animation: shimmer 3s infinite;
		}

		@keyframes shimmer {
			0% { transform: translateX(-100%); }
			100% { transform: translateX(100%); }
		}

		.sidebar-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 25px;
			padding-bottom: 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.logo-section {
			display: flex;
			align-items: center;
			gap: 15px;
		}

		.nav-buttons {
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.nav-btn {
			width: 35px;
			height: 35px;
			border-radius: 8px;
			background: rgba(255, 255, 255, 0.1);
			border: none;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
			text-decoration: none;
			font-size: 14px;
		}

		.nav-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(127, 176, 105, 0.2);
		}

		.logout-btn:hover {
			background: rgba(220, 53, 69, 0.2);
			color: #dc3545;
			box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
		}

		.logo {
			width: 40px;
			height: 40px;
			border-radius: 10px;
		}

		.logo-text {
			font-size: 1.5rem;
			font-weight: 700;
			color: #7fb069;
			text-shadow: 0 0 20px rgba(127, 176, 105, 0.3);
		}

		.search-box {
			position: relative;
			margin-bottom: 20px;
		}

		.search-input {
			width: 100%;
			padding: 12px 15px 12px 45px;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 25px;
			color: white;
			font-size: 14px;
			outline: none;
			transition: all 0.3s ease;
		}

		.search-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.search-input:focus {
			border-color: #7fb069;
			box-shadow: 0 0 0 3px rgba(127, 176, 105, 0.1);
		}

		.search-icon {
			position: absolute;
			left: 15px;
			top: 50%;
			transform: translateY(-50%);
			color: rgba(255, 255, 255, 0.6);
		}

		.chat-list {
			flex: 1;
			overflow-y: auto;
		}

		.chat-item {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 15px;
			border-radius: 15px;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-bottom: 8px;
			position: relative;
		}

		.chat-item:hover {
			background: rgba(255, 255, 255, 0.1);
			transform: translateX(5px);
		}

		.chat-item.active {
			background: linear-gradient(135deg, rgba(127, 176, 105, 0.2), rgba(127, 176, 105, 0.1));
			border: 1px solid rgba(127, 176, 105, 0.3);
		}

		.chat-avatar {
			width: 45px;
			height: 45px;
			border-radius: 50%;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: 600;
			position: relative;
			overflow: hidden;
		}

		.chat-avatar::before {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 200%;
			height: 200%;
			background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
			transform: rotate(45deg);
			animation: avatarShine 3s infinite;
		}

		@keyframes avatarShine {
			0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
			100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
		}

		.chat-info {
			flex: 1;
			min-width: 0;
		}

		.chat-name {
			font-weight: 600;
			color: white;
			margin-bottom: 4px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.chat-preview {
			font-size: 13px;
			color: rgba(255, 255, 255, 0.7);
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.chat-time {
			font-size: 12px;
			color: rgba(255, 255, 255, 0.5);
			white-space: nowrap;
		}

		.unread-badge {
			background: #7fb069;
			color: white;
			border-radius: 50%;
			width: 20px;
			height: 20px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 11px;
			font-weight: 600;
			position: absolute;
			top: 10px;
			right: 10px;
		}

		/* Main Chat Area Styles */
		.chat-main {
			flex: 1;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 20px;
			backdrop-filter: blur(20px);
			border: 1px solid rgba(255, 255, 255, 0.1);
			display: flex;
			flex-direction: column;
			position: relative;
			overflow: hidden;
		}

		.chat-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 20px 25px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
			background: rgba(255, 255, 255, 0.05);
		}

		.chat-header-info {
			display: flex;
			align-items: center;
			gap: 15px;
		}

		.chat-header-name {
			font-weight: 600;
			color: white;
			font-size: 1.1rem;
		}

		.chat-header-status {
			font-size: 13px;
			color: #7fb069;
			display: flex;
			align-items: center;
			gap: 5px;
		}

		.chat-header-status::before {
			content: '';
			width: 8px;
			height: 8px;
			background: #7fb069;
			border-radius: 50%;
			animation: pulse 2s infinite;
		}

		@keyframes pulse {
			0% { opacity: 1; }
			50% { opacity: 0.5; }
			100% { opacity: 1; }
		}

		.chat-header-actions {
			display: flex;
			gap: 10px;
		}

		.header-btn {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.1);
			border: none;
			color: rgba(255, 255, 255, 0.8);
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.header-btn:hover {
			background: rgba(127, 176, 105, 0.2);
			color: #7fb069;
			transform: scale(1.1);
		}

		.chat-messages {
			flex: 1;
			padding: 20px 25px;
			overflow-y: auto;
			display: flex;
			flex-direction: column;
			gap: 15px;
		}

		.message {
			display: flex;
			gap: 12px;
			max-width: 70%;
			animation: messageSlide 0.3s ease;
		}

		@keyframes messageSlide {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.message.sent {
			align-self: flex-end;
			flex-direction: row-reverse;
		}

		.message-avatar {
			width: 35px;
			height: 35px;
			border-radius: 50%;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: 600;
			font-size: 12px;
			flex-shrink: 0;
		}

		.message-content {
			display: flex;
			flex-direction: column;
			gap: 5px;
		}

		.message.sent .message-content {
			align-items: flex-end;
		}

		.message-bubble {
			padding: 12px 16px;
			border-radius: 18px;
			position: relative;
			word-wrap: break-word;
			max-width: 100%;
		}

		.message.received .message-bubble {
			background: rgba(255, 255, 255, 0.1);
			color: white;
			border-bottom-left-radius: 5px;
		}

		.message.sent .message-bubble {
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			color: white;
			border-bottom-right-radius: 5px;
			box-shadow: 0 2px 10px rgba(127, 176, 105, 0.3);
		}

		.message-time {
			font-size: 11px;
			color: rgba(255, 255, 255, 0.5);
			margin-top: 2px;
		}

		.chat-input-area {
			padding: 20px 25px;
			border-top: 1px solid rgba(255, 255, 255, 0.1);
			background: rgba(255, 255, 255, 0.05);
		}

		.input-container {
			display: flex;
			align-items: center;
			gap: 12px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 25px;
			padding: 8px 15px;
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
		}

		.input-container:focus-within {
			border-color: #7fb069;
			box-shadow: 0 0 0 3px rgba(127, 176, 105, 0.1);
		}

		.message-input {
			flex: 1;
			background: transparent;
			border: none;
			color: white;
			font-size: 14px;
			outline: none;
			padding: 8px 0;
		}

		.message-input::placeholder {
			color: rgba(255, 255, 255, 0.6);
		}

		.input-btn {
			width: 35px;
			height: 35px;
			border-radius: 50%;
			background: transparent;
			border: none;
			color: rgba(255, 255, 255, 0.6);
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.input-btn:hover {
			background: rgba(255, 255, 255, 0.1);
			color: white;
		}

		.send-btn {
			width: 35px;
			height: 35px;
			border-radius: 50%;
			background: linear-gradient(135deg, #7fb069, #5a8a4a);
			border: none;
			color: white;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.send-btn:hover {
			transform: scale(1.1);
			box-shadow: 0 2px 10px rgba(127, 176, 105, 0.4);
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.chat-container {
				flex-direction: column;
				height: auto;
				padding: 10px;
			}

			.chat-sidebar {
				width: 100%;
				height: 200px;
				margin-bottom: 10px;
			}

			.chat-main {
				height: 500px;
			}

			.message {
				max-width: 85%;
			}
		}
	</style>
    </head>

<body>
	<div class="chat-container">
		<!-- Chat Sidebar -->
		<div class="chat-sidebar">
			<div class="sidebar-header">
				<div class="logo-section">
					<img src="{{ asset('assest/Biz.png') }}" alt="BizNest Logo" class="logo">
					<span class="logo-text">BizNest</span>
				</div>
				<div class="nav-buttons">
					<a href="{{ url('user/dashboard/dashboard') }}" class="nav-btn" title="Dashboard">
						<i class="fas fa-tachometer-alt"></i>
					</a>
					<form method="POST" action="{{ route('logout') }}" style="display: inline;">
						@csrf
						<button type="submit" class="nav-btn logout-btn" title="Logout">
							<i class="fas fa-sign-out-alt"></i>
						</button>
					</form>
				</div>
			</div>
			
			<div class="search-box">
				<i class="fas fa-search search-icon"></i>
				<input type="text" class="search-input" placeholder="Search conversations...">
			</div>
			
			<div class="chat-list">
				<!-- Sample Chat Items -->
				<div class="chat-item active">
					<div class="chat-avatar">JD</div>
					<div class="chat-info">
						<div class="chat-name">John Doe</div>
						<div class="chat-preview">Hey, how's your business going?</div>
					</div>
					<div class="chat-time">2m</div>
					<div class="unread-badge">3</div>
				</div>
				
				<div class="chat-item">
					<div class="chat-avatar">SM</div>
					<div class="chat-info">
						<div class="chat-name">Sarah Miller</div>
						<div class="chat-preview">Thanks for the recommendation!</div>
					</div>
					<div class="chat-time">1h</div>
				</div>
				
				<div class="chat-item">
					<div class="chat-avatar">AB</div>
					<div class="chat-info">
						<div class="chat-name">Alex Brown</div>
						<div class="chat-preview">Can we schedule a meeting?</div>
					</div>
					<div class="chat-time">3h</div>
					<div class="unread-badge">1</div>
				</div>
			</div>
		</div>
		
		<!-- Main Chat Area -->
		<div class="chat-main">
			<div class="chat-header">
				<div class="chat-header-info">
					<div class="chat-avatar">JD</div>
					<div>
						<div class="chat-header-name">John Doe</div>
						<div class="chat-header-status">Online</div>
					</div>
				</div>
				<div class="chat-header-actions">
					<button class="header-btn"><i class="fas fa-phone"></i></button>
					<button class="header-btn"><i class="fas fa-video"></i></button>
					<button class="header-btn"><i class="fas fa-ellipsis-v"></i></button>
				</div>
			</div>
			
			<div class="chat-messages">
				<!-- Sample Messages -->
				<div class="message received">
					<div class="message-avatar">JD</div>
					<div class="message-content">
						<div class="message-bubble">
							Hey! I saw your business listing on BizNest. Very impressive!
						</div>
						<div class="message-time">10:30 AM</div>
					</div>
				</div>
				
				<div class="message sent">
					<div class="message-content">
						<div class="message-bubble">
							Thank you! We've been working hard to build our presence.
						</div>
						<div class="message-time">10:32 AM</div>
					</div>
			</div>
				
				<div class="message received">
					<div class="message-avatar">JD</div>
					<div class="message-content">
						<div class="message-bubble">
							I'm interested in your services. Could we discuss a potential collaboration?
						</div>
						<div class="message-time">10:35 AM</div>
					</div>
				</div>
			</div>
			
			<div class="chat-input-area">
				<div class="input-container">
					<button class="input-btn"><i class="fas fa-paperclip"></i></button>
					<input type="text" class="message-input" placeholder="Type your message...">
					<button class="input-btn"><i class="fas fa-smile"></i></button>
					<button class="send-btn"><i class="fas fa-paper-plane"></i></button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Back to Home Link -->
	<div style="position: fixed; top: 20px; left: 20px; z-index: 1000;">
		<a href="{{ url('/') }}" style="color: #7fb069; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.1); padding: 10px 15px; border-radius: 25px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" 
		   onmouseover="this.style.background='rgba(127, 176, 105, 0.2)'" 
		   onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
			<i class="fas fa-arrow-left"></i> Back to Home
		</a>
	</div>
	
	<div id='chatapp' style="display: none;"></div>
	
	<script>
		// Enhanced Chat Functionality
		document.addEventListener('DOMContentLoaded', function() {
			// Chat data structure
			const chatData = {
				'john-doe': {
					name: 'John Doe',
					avatar: 'JD',
					status: 'Online',
					messages: [
						{ type: 'received', text: 'Hey! I saw your business listing on BizNest. Very impressive!', time: '10:30 AM', avatar: 'JD' },
						{ type: 'sent', text: 'Thank you! We\'ve been working hard to build our presence.', time: '10:32 AM' },
						{ type: 'received', text: 'I\'m interested in your services. Could we discuss a potential collaboration?', time: '10:35 AM', avatar: 'JD' }
					]
				},
				'sarah-miller': {
					name: 'Sarah Miller',
					avatar: 'SM',
					status: 'Online',
					messages: [
						{ type: 'received', text: 'Hi! I found your business through BizNest. Great work!', time: '9:15 AM', avatar: 'SM' },
						{ type: 'sent', text: 'Thank you so much! How can I help you today?', time: '9:18 AM' },
						{ type: 'received', text: 'Thanks for the recommendation! It was exactly what I needed.', time: '9:45 AM', avatar: 'SM' }
					]
				},
				'alex-brown': {
					name: 'Alex Brown',
					avatar: 'AB',
					status: 'Away',
					messages: [
						{ type: 'received', text: 'Hello! I\'m looking for a business partner in Colombo.', time: '8:20 AM', avatar: 'AB' },
						{ type: 'sent', text: 'That sounds interesting! Tell me more about your project.', time: '8:25 AM' },
						{ type: 'received', text: 'Can we schedule a meeting to discuss this further?', time: '8:30 AM', avatar: 'AB' }
					]
				}
			};

			let currentChat = 'john-doe';

			// DOM elements
			const chatItems = document.querySelectorAll('.chat-item');
			const messageInput = document.querySelector('.message-input');
			const sendBtn = document.querySelector('.send-btn');
			const chatMessages = document.querySelector('.chat-messages');
			const chatHeaderName = document.querySelector('.chat-header-name');
			const chatHeaderStatus = document.querySelector('.chat-header-status');
			const chatHeaderAvatar = document.querySelector('.chat-header .chat-avatar');

			// Function to format current time
			function getCurrentTime() {
				const now = new Date();
				return now.toLocaleTimeString('en-US', { 
					hour: 'numeric', 
					minute: '2-digit', 
					hour12: true 
				});
			}

			// Function to create message HTML
			function createMessageHTML(message) {
				if (message.type === 'sent') {
					return `
						<div class="message sent">
							<div class="message-content">
								<div class="message-bubble">${message.text}</div>
								<div class="message-time">${message.time}</div>
							</div>
						</div>
					`;
				} else {
					return `
						<div class="message received">
							<div class="message-avatar">${message.avatar}</div>
							<div class="message-content">
								<div class="message-bubble">${message.text}</div>
								<div class="message-time">${message.time}</div>
							</div>
						</div>
					`;
				}
			}

			// Function to load chat messages
			function loadChatMessages(chatId) {
				const chat = chatData[chatId];
				if (!chat) return;

				// Update header
				chatHeaderName.textContent = chat.name;
				chatHeaderStatus.textContent = chat.status;
				chatHeaderAvatar.textContent = chat.avatar;

				// Clear and load messages
				chatMessages.innerHTML = '';
				chat.messages.forEach(message => {
					chatMessages.innerHTML += createMessageHTML(message);
				});

				// Scroll to bottom
				chatMessages.scrollTop = chatMessages.scrollHeight;
			}

			// Function to add new message
			function addMessage(text, type = 'sent') {
				const message = {
					type: type,
					text: text,
					time: getCurrentTime(),
					avatar: type === 'received' ? chatData[currentChat].avatar : null
				};

				// Add to chat data
				chatData[currentChat].messages.push(message);

				// Add to DOM
				const messageElement = document.createElement('div');
				messageElement.innerHTML = createMessageHTML(message);
				chatMessages.appendChild(messageElement.firstElementChild);

				// Scroll to bottom with smooth animation
				chatMessages.scrollTo({
					top: chatMessages.scrollHeight,
					behavior: 'smooth'
				});

				// Update chat preview in sidebar
				updateChatPreview(currentChat, text);
			}

			// Function to update chat preview in sidebar
			function updateChatPreview(chatId, lastMessage) {
				const chatItem = document.querySelector(`[data-chat="${chatId}"]`);
				if (chatItem) {
					const preview = chatItem.querySelector('.chat-preview');
					const time = chatItem.querySelector('.chat-time');
					if (preview) preview.textContent = lastMessage.length > 30 ? lastMessage.substring(0, 30) + '...' : lastMessage;
					if (time) time.textContent = 'now';
				}
			}

			// Function to send message
			function sendMessage() {
				const message = messageInput.value.trim();
				if (message) {
					// Add sent message
					addMessage(message, 'sent');
					messageInput.value = '';

					// Simulate typing indicator and auto-reply (for demo purposes)
					setTimeout(() => {
						const replies = [
							'Thanks for your message!',
							'That sounds great!',
							'I\'ll get back to you soon.',
							'Interesting point!',
							'Let me think about that.',
							'Absolutely!'
						];
						const randomReply = replies[Math.floor(Math.random() * replies.length)];
						addMessage(randomReply, 'received');
					}, 1500 + Math.random() * 2000); // Random delay between 1.5-3.5 seconds
				}
			}

			// Add chat IDs to chat items for easier selection
			chatItems.forEach((item, index) => {
				const chatIds = ['john-doe', 'sarah-miller', 'alex-brown'];
				item.setAttribute('data-chat', chatIds[index]);
			});

			// Chat item click handlers
			chatItems.forEach(item => {
				item.addEventListener('click', function() {
					// Remove active class from all items
					chatItems.forEach(i => i.classList.remove('active'));
					// Add active class to clicked item
					this.classList.add('active');
					
					// Get chat ID and load messages
					const chatId = this.getAttribute('data-chat');
					if (chatId && chatData[chatId]) {
						currentChat = chatId;
						loadChatMessages(chatId);
						
						// Remove unread badge if present
						const badge = this.querySelector('.unread-badge');
						if (badge) {
							badge.style.opacity = '0';
							setTimeout(() => badge.remove(), 300);
						}
					}
				});
			});

			// Send button click handler
			sendBtn.addEventListener('click', sendMessage);

			// Enter key handler for message input
			messageInput.addEventListener('keypress', function(e) {
				if (e.key === 'Enter' && !e.shiftKey) {
					e.preventDefault();
					sendMessage();
				}
			});

			// Search functionality
			const searchInput = document.querySelector('.search-input');
			searchInput.addEventListener('input', function() {
				const searchTerm = this.value.toLowerCase();
				chatItems.forEach(item => {
					const name = item.querySelector('.chat-name').textContent.toLowerCase();
					const preview = item.querySelector('.chat-preview').textContent.toLowerCase();
					
					if (name.includes(searchTerm) || preview.includes(searchTerm)) {
						item.style.display = 'flex';
					} else {
						item.style.display = 'none';
					}
				});
			});

			// Load initial chat
			loadChatMessages(currentChat);

			// Add typing animation to input
			messageInput.addEventListener('focus', function() {
				this.parentElement.style.transform = 'scale(1.02)';
			});

			messageInput.addEventListener('blur', function() {
				this.parentElement.style.transform = 'scale(1)';
			});
		});
	</script>
</body>
</html>
