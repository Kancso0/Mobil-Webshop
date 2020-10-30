<?php

require_once('config.php');

if(isset($_POST['action']))
{

    if($_POST['action'] == "loadCartData")   // Load Cart Data for Cars
    {
        $total_price = 0;
        $total_item = 0;

        $output = '
        <div class="table-responsive" id="order_table">
        <table class="table table-bordered table-striped" >
                <tr>  
                   <th width="40%">Name</th>  
                   <th width="10%">Type</th>  
                   <th width="20%">Vintage</th>  
                   <th width="15%">Engine</th>  
                   <th width="15%">Engine Type</th>
                   <th width="5%">Price</th>   
                </tr>
        ';

        if(!empty($_SESSION['shopping_cart']))
        {
            foreach($_SESSION['shopping_cart'] as $keys => $values)
            {
                $output .= '
                    <tr>
                    <td>'.$values["name"].'</td>
                    <td>'.$values["type"].'</td>
                    <td>'.$values["vintage"].'</td>
                    <td>'.$values["engine"].'</td>
                    <td>'.$values["enginetype"].'</td>
                    <td align="right">'.$values["price"].' Ft</td>
                    <td><button name="remove" class="btn btn-danger btn-xs remove" id="'. $values["id"].'">Remove</button></td>
                    </tr>
                    ';
                    $total_price = $total_price + $values["price"];
                    $total_item = $total_item + 1;
                
            }
                $output .= '
                    <tr>  
                            <td colspan="5" align="right" style="font-weight:bold;">Total</td>  
                            <td align="right" style="font-weight:bold;">'.$total_price.'</td>  
                            <td></td>  
                        </tr>
                    ';
        }
        else
        {
                $output .= '
                    <tr>
                    <td colspan="5" align="center">
                    Your Cart is Empty!
                    </td>
                    </tr>
                    ';
        }
        $output .= '</table></div>';
        $data = array(
            'cart_details'  => $output,
            'total_item'  => $total_item
           ); 
           
           echo json_encode($data);
           
    }                                          // --Load Cart Data for Cars


    
    if($_POST['action'] == "getCarByID" && isset($_POST['car_id']))        // Load card by ID for cart
    {
        $sql = "SELECT * FROM cars WHERE id=".$_POST['car_id']."";
        $result = Query($sql);
        $row = fetch_data($result);
        $result_array = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "type" => $row['type'],
            "vintage" => $row['vintage'],
            "engine" => $row['engine'],
            "enginetype" => $row['enginetype'],
            "price" => $row['price']

        );

        if(isset($_SESSION['shopping_cart']))
                
            {
                $already_added = 0;

                foreach($_SESSION['shopping_cart'] as $keys => $values)
                {
                    if($_SESSION['shopping_cart'][$keys]['id'] == $_POST['car_id'])
                        {
                            $already_added++;
                            echo "You have already added this item to the cart!";
                        }
                }

                if($already_added==0)
                    {
                        $_SESSION['shopping_cart'][] = $result_array;
                    }

            }
        else
            {
                $_SESSION['shopping_cart'][] = $result_array;
            }
         
         
             
    }


    if($_POST['action'] == "removeRow" && isset($_POST['rowID']))  // Delete the specificed ROW from Session
    {
        foreach($_SESSION['shopping_cart'] as $keys => $values)
        {
            if($_SESSION['shopping_cart'][$keys]['id'] == $_POST['rowID'])
            {
                unset($_SESSION['shopping_cart'][$keys]);
            }
        }
    }

    if($_POST['action'] == "clearCart")   // Clear Shopping_cart SESSION
    {
        unset($_SESSION['shopping_cart']);
    }



   
}



?>