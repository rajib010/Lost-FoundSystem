<!-- CREATE TABLE user_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    profileImg LONGBLOB, 
    phone_number VARCHAR(20) UNIQUE NOT NULL,
    user_type INT NOT NULL DEFAULT 0,
    password VARCHAR(255) NOT NULL,  
    address VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    verify_code VARCHAR(100),
    code_generated_at DATETIME DEFAULT NULL
);
 -->


 <!-- 
 CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(200) NOT NULL,
    image LONGBLOB,  
    category VARCHAR(100) NOT NULL,
    status INT NOT NULL DEFAULT 1,
    time DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES user_info(id) ON DELETE CASCADE
);

 -->


 <!-- CREATE TABLE reviews(
    id INT PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    satisfaction INT NOT NULL,
    found INT NOT NULL,
    recommend INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    time DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES user_info(id)
    ) -->


    <!-- CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    receivedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_info(id) ON DELETE CASCADE
); -->
