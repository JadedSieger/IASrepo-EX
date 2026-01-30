# Localhosted and Barebones. Do **NOT** copy this UI to the last pixel.
---


# Customization Steps 

### [1. XAMPP setup](#xampp-setup)

### [2. Setting up Localhost Database](#setting-up-localhost)

### [3. Customizing HTML and CSS](#customizing-html-and-css)



---
# XAMPP Setup

> ### 1. After downloading "feelingradation" from this repo, extract it in this File Structure:

```js
-> xampp
     | -> htdocs
```
Rename your folder.


> ### 2. Open XAMPP Control Panel.
  > 1. Start Apache and SQL Service.
  > 2. Click "Admin" under the SQL Service.
  > 3. Once opened, Click the New Button.

  <img width="165" height="44" alt="image" src="https://github.com/user-attachments/assets/cdeafad8-18b4-41dd-8e0d-503f06611e7d" />
  
> 4. Create your Database, for this example, we will call it "users". After creation, go to SQL.
  <img width="501" height="68" alt="image" src="https://github.com/user-attachments/assets/96a26e09-001a-4a7f-a3ac-0a3bdac1760f" />

> 5. Paste this code:
  ```js
  CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  ```  
 and click the Go button on the middle part of the screen. 


---

# Setting Up Localhost
> ### 1. Set up your database variables.

```php
<?php
function getDBConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "users";
    $port = 3306;


$connection = new mysqli($servername, $username, $password, $database);
if($connection->connect_error){
    die("Error: Failed to connect to MySQL. ".$connection->connect_error);
}

return $connection;
}

?>
```
there is nothing you have to change with this code. It is already set-up for localhosting.

--- 
# Customizing HTML and CSS

### You will notice the html section in your `index.php` and `login.php`.

```php
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="auth-container">
    <h2>Sign Up</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Sign Up</button>
    </form>

    <div class="message"><?php echo $message; ?></div>

    <p>
        <a href="login.php">Already have an account?</a>
    </p>
</div>

</body>
</html>
```
 - html section of index.php


This should be the only part you should edit for your front end.

### CSS Editing
> Make your styles.css
> Every design property change happens here.
