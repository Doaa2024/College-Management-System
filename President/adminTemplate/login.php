<?php
session_start();
require("DAL/dal.class.php");
$dal = new DAL();
$error = '';
$done = 'True';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) &&  isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Retrieve the hashed password from the database based on the username
        $sql_user = "SELECT Role, Password,UserID,FacultyID,DepartmentID FROM users WHERE Username = ?";



        // Check employee table first
        $result = $dal->getdata($sql_user, [$username]);
        if ($result && count($result) > 0) {
            $storedPasswordHash = $result[0]['Password'];
            $user_type = $result[0]['Role'];
            $userID = $result[0]['UserID'];
            $facultyID = $result[0]['FacultyID'];
            $departmentID = $result[0]['DepartmentID'];
            // Verify the user-provided password against the stored hash
            if (password_verify($password, $storedPasswordHash) && $user_type == 'President') {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['userID'] = $userID;
                $_SESSION['login'] = true;

                echo "<script>
              
                        window.location.href='http://localhost/mosque-website-template/President/adminTemplate/';
                    
            </script>";
                exit; // Exit to prevent further execution


            }
            if (password_verify($password, $storedPasswordHash) && $user_type == 'Secretary') {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['userID'] = $userID;
                $_SESSION['login'] = true;

                echo "<script>
              
                        window.location.href='http://localhost/mosque-website-template/Secretary/adminTemplate/index.php';
                    
            </script>";
                exit; // Exit to prevent further execution


            }
            if (password_verify($password, $storedPasswordHash) && $user_type == 'Branch Head') {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['userID'] = $userID;
                $_SESSION['login'] = true;

                echo "<script>
              
                        window.location.href='http://localhost/mosque-website-template/BranchPresident/adminTemplate/index.php';
                    
            </script>";
                exit; // Exit to prevent further execution


            }
            if (password_verify($password, $storedPasswordHash) && $user_type == 'Dean') {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['userID'] = $userID;
                $_SESSION['facultyID'] = $facultyID;
                $_SESSION['login'] = true;

                echo "<script>
              
                        window.location.href='http://localhost/mosque-website-template/Dean/adminTemplate/index.php';
                    
            </script>";
                exit; // Exit to prevent further execution

            }
            if (password_verify($password, $storedPasswordHash) && $user_type == 'Assistant Dean') {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['userID'] = $userID;
                $_SESSION['departmentID'] = $departmentID;
                $_SESSION['login'] = true;

                echo "<script>
              
                        window.location.href='http://localhost/mosque-website-template/Assistant Dean/adminTemplate/index.php';
                    
            </script>";
                exit; // Exit to prevent further execution


            }
        }


        // If neither employee nor customer found, set error message
        $error = 'Invalid UserName or Password!';
    }
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background-color: #f5f5f5;
        background-image: url('img/admin4.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .form_main {
        width: 100%;
        max-width: 380px;
        padding: 60px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.5);
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
        border-radius: 40px;
        border: 1px solid rgba(135, 206, 250, .5);
        /* Light blue border */
        margin: 0 12px;
        transition: transform 0.3s ease;
    }

    .errorText {
        font-size: medium;
        margin-right: 35%;
        margin-top: 2px;
        color: rgb(251, 30, 30);
        position: relative;
        z-index: 2;
    }

    .form_main::before {
        position: absolute;
        content: "";
        width: 360px;
        height: 360px;
        background-color: rgba(135, 206, 250, .9);
        /* Light blue background */
        transform: rotate(45deg);
        left: -216px;
        bottom: 36px;
        z-index: 1;
        border-radius: 30px;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.082);
    }

    .form_main:hover {
        transform: translateY(-10px);
    }

    .heading {
        font-size: 2.4em;
        color: #2e2e2e;
        font-weight: 700;
        margin: 6px 0 12px 0;
        z-index: 2;
        text-align: center;
    }

    .inputContainer {
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .inputIcon {
        position: absolute;
        left: 4px;
    }

    .inputField {
        width: 100%;
        height: 36px;
        background-color: transparent;
        border: none;
        border-bottom: 2px solid #333;
        margin: 12px 0;
        color: black;
        font-size: 0.96em;
        font-weight: 500;
        box-sizing: border-box;
        padding-left: 36px;
    }

    .inputField:focus {
        outline: none;
        border-bottom: 2px solid rgba(135, 206, 250, 1);
        /* Light blue focus */
    }

    .inputField::placeholder {
        color: rgb(80, 80, 80);
        font-size: 1.2em;
        font-weight: 500;
    }

    #button {
        z-index: 2;
        position: relative;
        width: 100%;
        border: none;
        border-radius: 40px;
        background-color: rgba(135, 206, 250, .9);
        /* Light blue background */
        padding: 18px;
        color: black;
        font-size: 1.2em;
        font-weight: bold;
        letter-spacing: 1px;
        margin: 12px 0;
        cursor: pointer;
    }

    #button:hover {
        background-color: rgba(114, 180, 210, 0.9);
        /* Slightly darker blue on hover */
    }

    .forgotLink {
        z-index: 2;
        font-size: 1.3em;
        font-weight: 500;
        color: rgb(44, 24, 128);
        text-decoration: none;
        padding: 9.6px 18px;
        border-radius: 20px;
        font-style: oblique;
    }

    .forgotLink:hover {
        color: rgba(135, 206, 250, .9);
        /* Light blue on hover */
        text-decoration: underline;
    }

    @media (max-width: 700px) {
        .form_main {
            padding: 30px 20px;
            max-width: 90%;
            width: 100%;
        }

        .inputField {
            font-size: 0.9em;
            padding-left: 34px;
        }

        #button {
            padding: 16px;
            font-size: 1.1em;
        }
    }

    @media (max-width: 480px) {
        .form_main {
            padding: 22px;
            max-width: 90%;
            width: 100%;
        }

        .inputField {
            font-size: 0.84em;
            padding-left: 32px;
        }

        #button {
            padding: 15px;
            font-size: 1em;
        }
    }
</style>

<body>
    <form action="" class="form_main" method="post">
        <p class="heading">Login</p>
        <div class="inputContainer">
            <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2e2e2e"
                viewBox="0 0 16 16">
                <path
                    d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z">
                </path>
            </svg>
            <input type="text" class="inputField" id="username" placeholder="Username" name="username">
        </div>

        <div class="inputContainer">
            <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2e2e2e"
                viewBox="0 0 16 16">
                <path
                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input type="password" class="inputField" id="password" placeholder="Password" name="password">

        </div>
        <p class="errorText"> <?php echo $error ?> </p>
        <button id="button" type="submit">Submit</button>
        <a class="forgotLink" href="#">Forgot your password?</a>
    </form>
</body>