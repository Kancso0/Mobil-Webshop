<?php

require_once('config.php');

    function string($string) 
    {
        return htmlentities($string);
    }
    
    // redirect Users

    function redirect($location)
    {
        return header("location:{$location}");
    }

    // set Session message

    function set_message($msg)
    {
        if(!empty($msg)) {
            $_SESSION['Message'] = $msg;
        } else {
            $msg = "";
        }
    }

    // display Message 

    function display_message()
    {
        if(isset($_SESSION['Message']))
        {
            echo $_SESSION['Message'];
            unset($_SESSION['Message']);
        }
    }

    // Generate Token

    function generate_token()
    {
        $token = $_SESSION['Token'] = md5(uniqid(mt_rand(), true));
        return $token;
    }

    // ************** USER VALIDATION ********** 

    // User validation
    
    function signupForm_validation()
    {
        if(isset($_POST['reg_submit']))
        {
            $username = string($_POST['username']);
            $fullname = htmlspecialchars($_POST['fullname']);
            $email = string($_POST['email']);
            $first_phone = string($_POST['first_phone']);
            $phone = string($_POST['phone']);
            $password = string($_POST['password']);
            $confPassword = string($_POST['confPassword']);

            $phone_number = $first_phone . $phone;

            echo $fullname;


            $Errors = [];
            $min = 5;
            $max = 20;

            if(strlen($username) < $min){
                $Errors[] = "Username cannot be less than {$min} characters";
            }
            if(strlen($username) > $max){
                $Errors[] = "Username cannot be more than {$max} characters";
            }
            if(!preg_match("/^[a-zA-Z,0-9]*$/", $username)){
                $Errors[] = "Username cannot have special characters";
            }

            if(strlen($phone) != 7)
            {
                $Errors[] = "Phone number format is incorrect";
            }

            if(strlen($fullname) < 5)
            {
                $Errors[] = "Fullname must be 5 or more character";
            }

            if(Get_User_ByEmail($email) != false  && filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $Errors[] = 'Email already exist. Choose another one!';
            }

            if(Get_User_forValidation($username) != false){
                $Errors[] = "Username already exist. Choose another one!";
            }


            if($password != $confPassword)
            {
                $Errors[] = 'Password not match!';
            }

            if(strlen($password) < $min)
            {
                $Errors[] = "Password cannot be less than {$min} characters";
            }

            // display errors

            if(!empty($Errors))
            {
                foreach($Errors as $Error)
                {
                    echo '<div class="alert alert-danger" role="alert">'.$Error.'</div>';
                }
            }
            else 
            {
                if(user_reg($username, $email, $phone_number, $fullname, $password))
                {   
                    //echo '<div class="alert alert-success" role="alert">Registration Successfull! Redirecting...</div>';
                    set_message('<div class="alert alert-success text-center"  role="alert">Registration Successfull! You can to login.</div>');
                    redirect("login.php");
                    
                }
            }


        }
    }

    

   

    // Check User Exist
    // Get User for login

    function Get_User_forValidation($username)
    {
        $query = "SELECT * FROM users WHERE Username='$username'";
        $result = Query($query);
        if($res = fetch_data($result))
        {
            return $res;
        } 
        else
        {
            return false;
        }
        
    }

    // get User by Email

    function Get_User_ByEmail($email)
    {
        $query = "SELECT Username,Email,Phone,Fullname,Balance FROM users WHERE Email='$email'";;
        $result = Query($query);

        if($res = fetch_data($result))
        {
            return $res;
        } else 
        {
            return false;
        }
    }

    // Get User for display his data

    function Get_User_ByUsername($username)
    {
        $query = "SELECT Username,Email,Phone,Fullname,Balance FROM users WHERE Username='$username'";
        $result = Query($query);
        if($res = fetch_data($result))
        {
            return $res;
        } 
        else
        {
            return false;
        }
        
    }

    // User registration 

    function user_reg($username, $email, $phone_number, $fullname, $password)
    {
        $username = escape($username);
        $email = escape($email);
        $phone_number = escape($phone_number);
        $fullname = escape($fullname);
        $password = escape($password);

        

        if(Get_User_ByEmail($email) != false)
        {
            return true;
        } 
        else if(Get_User_forValidation($username) != false)
        {
            return true;

        } 
        else
        {
            // Send the user to the database

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $validation_code = md5($username . microtime(true));

            // query

            $sql = "INSERT INTO users (Username,Email,Phone,Fullname,Password,Validation_Code,Active) VALUES('$username','$email','$phone_number','$fullname','$hashed_password','$validation_code','0')";

            $result = Query($sql);
            confirm($result);

            return true;
        }


    }

    // Login form validation 

    function loginForm_validation()
    {
        if(isset($_POST['login_submit']))
        {
            $username = string($_POST['username']);
            $password = string($_POST['password']);
            $rememberMe = isset($_POST['rememberMe']);


            $User = Get_User_forValidation($username);

            if(!$User){
                echo '<div class="alert alert-danger text-center"  role="alert">Invalid Username!</div>';
            }
            else
            {
                // Validation successfull

                if(password_verify($password, $User['Password']))
                {
                   
                   $_SESSION['Username'] = $username;

                   if($rememberMe == true)
                   {
                       setcookie('Username', $username, time() + 86400);
                   }

                   redirect('dashboard.php');
                }

                //Invalid password
                else 
                {
                    echo '<div class="alert alert-danger text-center"  role="alert">Invalid Password!</div>';
                }
            }
        }

        
    }


    // Check the User LOGGED IN

    function Logged_In()
    {
        if(isset($_SESSION['Username']))
        {
            $user = Get_User_ByUsername($_SESSION['Username']);
            return $user;
        }
        else if(isset($_COOKIE['Username']))
        {
            $user = Get_User_ByUsername($_COOKIE['Username']);
            return $user;
        }
        else if(isset($_SESSION['GOG_accessToken']) && isset($_SESSION['email_gAuth']))  // Check Google Auth
        {
            $user = Get_User_ByEmail($_SESSION['email_gAuth']);
            return $user;
        }
        else if(isset($_SESSION['Face_accesToken']) && isset($_SESSION['email_fAuth']))  // Check Facebook Auth
        {
            $user = Get_User_ByEmail($_SESSION['email_fAuth']);
            return $user;
        }
        else
        {          
            return false;
        }
    }



    //////////////    Display Cars   ///////////////////

    function load_fullcars()
    {
        $sql = "SELECT * FROM cars";
        $query = Query($sql);
        $resultArray = array();

        while($row = fetch_data($query))
        {
            $resultArray[] = $row;
        }
        return $resultArray;

    }

    function load_cars()
    {     

            $sql = "SELECT * FROM cars WHERE price <= ".$_POST['price']." ORDER BY id ";
            $query = Query($sql);

            $output = '';
            if(row_count($query) > 0)
            {
                while($row = fetch_data($query))  
                {
                    $output .= '
                    <div class="col-6">
                        <div class="card mb-3" align="center">
                            <h3 class="card-header">'.$row['name'].'</h3>
                            <div class="card-body">
                            <h5 class="card-title">'.$row['type'].'</h5>
                        </div>
                        <img style="height: 400px; width: 100%;" src="'.$row['picture'].'"/>
                        <ul class="list-group list-group-flush" align="center">
                            <li class="list-group-item">'.$row['vintage'].'</li>
                            <li class="list-group-item">'.$row['engine'].'</li>
                            <li class="list-group-item">'.$row['enginetype'].'</li>
                            <li class="list-group-item">'.$row['price'].'</li>
                            <input type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-success add_to_cart" value="Buy Now!"></input>
                        </ul>
                        <div class="card">
                            <div class="card-body" id="descriptionField">
                            <h4 class="card-title">Description</h4>
                            <p class="card-text"></p>
                            </div>
                        </div>         
                        </div>
                     </div>
                    ';
                }
            }
            else           
            {
                $output = "No Cars Find";
            } 
            echo $output;
        
            
    }

    if(isset($_POST['action']) && $_POST['action'] == "loadCars")
    {
        load_cars();
    }

    

    //   *******   DISPLAY PHONES CHECKBOXES   *****************


    function display_checkboxes(string $option)
    {
        $sql = "SELECT DISTINCT $option FROM phones";
        $query = Query($sql);

        $resultArray = array();

        while($row = fetch_data($query))
        {
            $resultArray[] = $row;
        }
        return $resultArray;
    }

    function load_phones()
    {

        if(isset($_POST['page']))
        {
            $page = $_POST['page'];
        } else {
            $page = 1;
        }
        
        $limit = 2;
        $offset = ($page - 1) * $limit;

        
        // SQL

        $sql = "SELECT * FROM phones WHERE active = 1";
     

        if(isset($_POST['manufacturer']))
        {
            $manufacturer = implode("','", $_POST['manufacturer']);
            $sql .=" AND manufacturer IN('".$manufacturer."')";
        }

        if(isset($_POST['memorie']))
        {
            $memorie = implode("','", $_POST['memorie']);
            $sql .=" AND memorie IN('".$memorie."')";
        }

        if(isset($_POST['ram']))
        {
            $ram = implode("','", $_POST['ram']);
            $sql .=" AND ram IN('".$ram."')";
        }

        if(isset($_POST['camera']))
        {
            $camera = implode("','", $_POST['camera']);
            $sql .=" AND camera IN('".$camera."')";
        }

        if(isset($_POST['color']))
        {
            $color = implode("','", $_POST['color']);
            $sql .=" AND color IN('".$color."')";
        }

        if(isset($_POST['display']))
        {
            $display = implode("','", $_POST['display']);
            $sql .=" AND display IN('".$display."')";
        }

        if(isset($_POST['system']))
        {
            $system = implode("','", $_POST['system']);
            $sql .=" AND system IN('".$system."')";
        }
        
        // Get all rows with filtered querys
        $query2 = Query($sql);
        $totalRows = row_count($query2);

            if (($totalRows % $limit) !== 0)
            {
                $pagiNumbers = intdiv($totalRows, $limit) + 1;
            }
            else {
                $pagiNumbers = intdiv($totalRows, $limit);
            }

        // Set the limit value to the SQL query

            $sql .= " LIMIT $offset, $limit";

        $query = Query($sql);
        $count = row_count($query);
        $output = '';
        while($row = fetch_data($query))
        {
            $output .= '
            <div class="col-7 col-sm-4 col-lg-3 col-md-3">
                        <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:500px;">
                            <img src="'.$row['picture'].'" style="border:1px solid #ccc; border-radius:5px;" alt="" class="img-fluid" >
                            <div align="center" style="height:60px;font-size:20px;"><strong>'.$row['name'].'</strong></div>
                            <h4 style="text-align:center;" class="text-danger" >'.$row['price'].' Ft</h4>
                            <p style="text-align:center;">
                            Camera : '.$row['camera'].' MP<br />
                            Brand : '.$row['manufacturer'].' <br />
                            RAM : '.$row['ram'].' GB<br />
                            Storage : '.$row['memorie'].' GB </p>
                            <ul class="list-group list-group-flush" align="center">  
                                <input type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-success add_to_cart" value="Buy Now!"></input>
                            </ul>
                        </div>

                </div>
            ';
        }
        $pagination = '';
        for($i = 1; $i <= $pagiNumbers; $i++)
        {
            if($page == $i)
            {
                $pagination .= '
                <div style="width:40px;height:40px;border: 1px solid black;margin-right:10px;text-align: center; font-size:25px;cursor: pointer;background-color: red;"
                class="pagi_selector" id="'.$i.'"> '.$i.' </div>
                ';
                
            }else {

                $pagination .= '
            
                <div style="width:40px;height:40px;border: 1px solid black;margin-right:10px;text-align: center; font-size:25px;cursor: pointer;background-color: #03e3fc;"
                class="pagi_selector" id="'.$i.'"> '.$i.' </div>    
            
            ';

            }

            
        }

        $array = array(
            "phones" => $output,
            "pagination" => $pagination,
            "page" => $page
        );
        
        echo json_encode($array);
           
    }

    if(isset($_POST['action']) && $_POST['action'] == "loadPhones")
    {
        load_phones();
    }

?>