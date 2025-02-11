# YouTube Clone

A basic YouTube clone developed using **HTML, CSS, PHP, and MySQL**. This project allows users to upload, manage, and mark as favorite videos.

## Features
- **User Authentication**: Manage user sessions.
- **Video Upload**: Users can upload videos from their system.
- **Favorite Videos**: Mark videos as favorites and view them in a dedicated tab.
- **Video Management**: Users can delete uploaded videos.
- **Database Management**: Uses MySQL to store user details, videos, and favorites.

## Tech Stack
- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP (Apache)

## Setup Instructions
1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/your-repo.git
   ```
2. Start XAMPP and enable Apache & MySQL.
3. Import the database:
   - Open **phpMyAdmin**.
   - Create a new database (e.g., `youtube_clone`).
   - Import database `user_records.sql`.
4. Move the project folder to `htdocs`.
5. Open the browser and go to:
   ```sh
   http://localhost/youtube_clone
   ```

## Folder Structure
```
/project-root
│── includes/
│   ├── dbh.inc.php
│   ├── functions.inc.php
│   ├── login.inc.php
│   ├── logout.inc.php
│   ├── signup.inc.php
│── thumbnails/
│── Videos/
│   ├── fav/
│   ├── uploads/
│   │   ├── thumbnails/
│   ├── delete.php
│   ├── upload.php
│── footer.php
│── header.php
│── home.php
│── new_login.php
│── new_signup.php
│── profile.php
│── profile.png
│── README.md
│── toggle_favourite.php
│── user_records.sql
│── videos.php
│── view_video.php
```

## Future Enhancements
- Implement user authentication.
- Add a search and filter feature for videos.
- Improve UI/UX with modern styling.

## License
This project is open-source and available under the MIT License.

---
Feel free to modify and contribute! 🚀
