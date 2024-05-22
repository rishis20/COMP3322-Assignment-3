# Real-Time Web Chat Application

## Project Description
This project involves creating a real-time Web Chat application. The app will allow users to register, log in, and communicate with other users through a chatroom interface. It is developed using PHP and MySQL for backend operations, with JavaScript enhancing the front-end experience.

## Technologies Used
- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript (utilizing AJAX)
- **Development Environment:** LAMP stack implemented within Docker containers

## Features

### User Authentication
- Registration and login functionality using `@connect` email addresses.
- Client-side validations check for correct email domain and if the user already exists.
- Users receive feedback on authentication outcomes.

### Chat Capabilities
- Once logged in, users can send and receive messages instantly.
- The chat interface includes a message display area and a text input field.
- Automatic logout triggers after 120 seconds of inactivity to ensure security.

### Session Control
- Secure session management starts upon login and ends on user logout or due to inactivity.
- Ensures that chat-related features are accessible only during active sessions.

## Implementation Details

### Core Components
- `login.php`: Manages the user registration and login process.
- `check.php`: Handles AJAX requests for user verification.
- `chat.php`: Serves as the main interface for the chatroom.
- `chatmsg.php`: Processes sending and retrieving chat messages.

### Client-side Scripts
- `login.js`: Adds dynamic behavior to the login and registration forms.
- `chat.js`: Manages the chat functionality, including message sending and live updates.

### Styling
- `login.css`: Provides styling for the login and registration pages.
- `chat.css`: Defines the appearance of the chat interface.

## Database Design

### User Table Structure
Attributes include `id`, `useremail`, and `password`.
Creation command:
```sql
CREATE TABLE account (
  id smallint NOT NULL AUTO_INCREMENT, 
  useremail varchar(60) NOT NULL, 
  password varchar(50) NOT NULL, 
  PRIMARY KEY (id)
);
