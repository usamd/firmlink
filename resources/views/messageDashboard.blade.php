@extends('layouts.app')

@section('content')
<div class="chat-container">
    <!-- Chat Sidebar -->
    <div class="chat-sidebar">
        <div class="sidebar-header">
            <div class="logo-section">
                <img src="{{ asset('assest/Biz.png') }}" alt="BizNest" class="logo">
                <div class="logo-text">BizNest</div>
            </div>
            <div class="nav-buttons">
                <a href="{{ route('home') }}" class="nav-btn" title="Home">
                    <i class="fas fa-home"></i>
                </a>
                <a href="{{ route('profile.edit') }}" class="nav-btn" title="Profile">
                    <i class="fas fa-user"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-btn logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search contacts...">
        </div>

        <div class="chat-list">
            <!-- Users will be loaded here dynamically -->
            <div class="text-center py-4 text-gray-400">
                <i class="fas fa-spinner fa-spin"></i> Loading contacts...
            </div>
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="chat-main">
        <div class="chat-header">
            <div class="chat-title">Select a chat to start messaging</div>
            <div class="chat-actions">
                <button class="action-btn" title="User info">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>
        </div>

        <div class="chat-messages">
            <div class="empty-state">
                <i class="fas fa-comments"></i>
                <h3>Select a conversation</h3>
                <p>Choose a contact to start chatting</p>
            </div>
        </div>

        <div class="chat-input-container" style="display: none;">
            <div class="input-actions">
                <button class="action-btn" title="Attach file">
                    <i class="fas fa-paperclip"></i>
                </button>
                <button class="action-btn" title="Emoji">
                    <i class="far fa-smile"></i>
                </button>
            </div>
            <input type="text" class="message-input" placeholder="Type a message...">
            <button class="send-button">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Chat Container */
    .chat-container {
        display: flex;
        height: calc(100vh - 70px);
        background: #f5f7fb;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar Styles */
    .chat-sidebar {
        width: 350px;
        background: #fff;
        border-right: 1px solid #e0e4ea;
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        padding: 15px 20px;
        border-bottom: 1px solid #e0e4ea;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo {
        width: 32px;
        height: 32px;
        border-radius: 8px;
    }

    .logo-text {
        font-weight: 700;
        font-size: 1.2rem;
        color: #2d3748;
    }

    .nav-buttons {
        display: flex;
        gap: 8px;
    }

    .nav-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #f1f5f9;
        border: none;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .nav-btn:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .logout-btn:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Search Box */
    .search-box {
        position: relative;
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
    }

    .search-input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #cbd5e1;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 30px;
        top: 28px;
        color: #94a3b8;
    }

    /* Chat List */
    .chat-list {
        flex: 1;
        overflow-y: auto;
    }

    .chat-item {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .chat-item:hover, .chat-item.active {
        background: #f8fafc;
    }

    .chat-item.active {
        background: #f1f5f9;
    }

    .chat-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-weight: 600;
        color: #475569;
        font-size: 1.1rem;
    }

    .chat-info {
        flex: 1;
        min-width: 0;
    }

    .chat-name {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-preview {
        font-size: 0.85rem;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-time {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-left: 10px;
    }

    /* Main Chat Area */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #f8fafc;
    }

    .chat-header {
        padding: 20px;
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chat-title {
        font-weight: 600;
        color: #1e293b;
        font-size: 1.1rem;
    }

    .chat-actions {
        display: flex;
        gap: 10px;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #94a3b8;
        text-align: center;
        padding: 20px;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.7;
    }

    .empty-state h3 {
        color: #475569;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .empty-state p {
        font-size: 0.95rem;
    }

    /* Messages */
    .message {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 15px;
        position: relative;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .message.sent {
        background: #3b82f6;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 5px;
    }

    .message.received {
        background: white;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        align-self: flex-start;
        border-bottom-left-radius: 5px;
    }

    .message-time {
        font-size: 0.7rem;
        margin-top: 4px;
        text-align: right;
        opacity: 0.8;
    }

    .message.sent .message-time {
        color: rgba(255, 255, 255, 0.8);
    }

    .message.received .message-time {
        color: #94a3b8;
    }

    /* Input Area */
    .chat-input-container {
        padding: 15px 20px;
        background: white;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .input-actions {
        display: flex;
        gap: 5px;
    }

    .message-input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 25px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .message-input:focus {
        outline: none;
        border-color: #cbd5e1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .send-button {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #3b82f6;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .send-button:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chat-container {
            flex-direction: column;
            height: 100vh;
        }

        .chat-sidebar, .chat-main {
            width: 100%;
            height: 50%;
        }

        .chat-sidebar {
            border-right: none;
            border-bottom: 1px solid #e2e8f0;
        }

        .chat-main {
            height: 50%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CSRF Token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentUserId = null;

        // DOM Elements
        const chatList = document.querySelector('.chat-list');
        const chatMessages = document.querySelector('.chat-messages');
        const messageInput = document.querySelector('.message-input');
        const sendButton = document.querySelector('.send-button');
        const searchInput = document.querySelector('.search-input');
        const chatInputContainer = document.querySelector('.chat-input-container');
        const emptyState = document.querySelector('.empty-state');

        // Load users from the server
        async function loadUsers() {
            try {
                const response = await fetch('/chat/users');
                const data = await response.json();
                
                if (data.status === 'success') {
                    renderUsers(data.users);
                    // Load first user's messages by default if there are users
                    if (data.users.length > 0) {
                        loadMessages(data.users[0].id);
                    }
                }
            } catch (error) {
                console.error('Error loading users:', error);
            }
        }

        // Render users in the sidebar
        function renderUsers(users) {
            if (users.length === 0) {
                chatList.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <h3>No contacts found</h3>
                        <p>You don't have any contacts yet</p>
                    </div>
                `;
                return;
            }

            chatList.innerHTML = users.map(user => `
                <div class="chat-item" data-user-id="${user.id}">
                    <div class="chat-avatar">${user.name.charAt(0).toUpperCase()}</div>
                    <div class="chat-info">
                        <div class="chat-name">${user.name}</div>
                        <div class="chat-preview">${user.email}</div>
                    </div>
                    <div class="chat-time">${user.is_online ? 'Online' : user.last_seen}</div>
                </div>
            `).join('');

            // Add click event to chat items
            document.querySelectorAll('.chat-item').forEach(item => {
                item.addEventListener('click', () => {
                    const userId = item.dataset.userId;
                    document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                    loadMessages(userId);
                });
            });

            // Activate first user by default
            if (users.length > 0) {
                const firstUser = chatList.firstElementChild;
                if (firstUser) firstUser.classList.add('active');
            }
        }

        // Load messages for a specific user
        async function loadMessages(userId) {
            if (!userId) return;
            
            currentUserId = userId;
            chatMessages.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-spinner fa-spin"></i> Loading messages...
                </div>
            `;
            
            try {
                const response = await fetch(`/chat/messages/${userId}`);
                const messages = await response.json();
                
                // Show chat input when a user is selected
                chatInputContainer.style.display = 'flex';
                emptyState.style.display = 'none';
                
                renderMessages(messages);

                // Update chat header with user info
                const userElement = document.querySelector(`.chat-item[data-user-id="${userId}"]`);
                if (userElement) {
                    const userName = userElement.querySelector('.chat-name').textContent;
                    document.querySelector('.chat-title').textContent = userName;
                }
            } catch (error) {
                console.error('Error loading messages:', error);
                chatMessages.innerHTML = `
                    <div class="text-center py-4 text-red-500">
                        <i class="fas fa-exclamation-circle"></i> Failed to load messages
                    </div>
                `;
            }
        }

        // Render messages in the chat area
        function renderMessages(messages) {
            if (!messages || messages.length === 0) {
                chatMessages.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-comment-slash"></i>
                        <h3>No messages yet</h3>
                        <p>Start the conversation by sending a message</p>
                    </div>
                `;
                return;
            }

            chatMessages.innerHTML = messages.map(message => {
                const isSent = message.sender_id === {{ auth()->id() }};
                const time = new Date(message.created_at).toLocaleTimeString([], { 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });
                
                return `
                    <div class="message ${isSent ? 'sent' : 'received'}">
                        <div class="message-content">${message.message}</div>
                        <div class="message-time">${time}</div>
                    </div>
                `;
            }).join('');

            // Scroll to bottom
            scrollToBottom();
        }

        // Send a new message
        async function sendMessage() {
            const message = messageInput.value.trim();
            if (!message || !currentUserId) return;

            // Optimistically add the message to the UI
            const tempId = Date.now();
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            const messageElement = document.createElement('div');
            messageElement.className = 'message sent';
            messageElement.id = `msg-${tempId}`;
            messageElement.innerHTML = `
                <div class="message-content">${message}</div>
                <div class="message-time">${time}</div>
            `;
            
            chatMessages.appendChild(messageElement);
            scrollToBottom();
            
            // Clear input
            messageInput.value = '';

            try {
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        receiver_id: currentUserId,
                        message: message
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to send message');
                }

                const data = await response.json();
                
                // Update the message with the server response
                if (data.message) {
                    messageElement.id = `msg-${data.message.id}`;
                }
                
            } catch (error) {
                console.error('Error sending message:', error);
                // Show error state on the message
                messageElement.innerHTML += `
                    <div class="message-error">
                        <i class="fas fa-exclamation-circle"></i> Not delivered
                    </div>
                `;
            }
        }

        // Helper function to scroll chat to bottom
        function scrollToBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Event Listeners
        sendButton.addEventListener('click', sendMessage);
        
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Search functionality
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.chat-item').forEach(item => {
                const userName = item.querySelector('.chat-name').textContent.toLowerCase();
                item.style.display = userName.includes(searchTerm) ? 'flex' : 'none';
            });
        });

        // Initialize chat
        loadUsers();
    });
</script>
@endpush

@endsection
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
