<?php include_once('views/header.php') ?>

<?php include_once('views/navbar.php') ?>

<?php   

   if(!Logged_In())
    {
        redirect('login.php');
    }
    else {
        $user = Logged_In();
        //print_r($user);       
    }

?>

<!-- Display user info  -->

<?php include_once('views/profile.php') ?>

<div class="d-flex justify-content-center ml-5 my-4">
<span class="font-weight-bold indigo-text mr-3 mt-0">0</span>
  <div class="w-75">
    <input type="range" class="custom-range"  min="0" max="20000000" step="100000" value="10000000" id="min_price" name="min_price">
  </div>
  <span class="font-weight-bold indigo-text ml-3 mt-0">20000000</span>
</div>
<div id="range_value" align="center" style="white-space: pre-line; margin-top: -20px; font-weight:bold">10000000</div>

<!-- // Display user info  -->



<div class="container-md mx-5" >
        <div class="row mt-3" id="display_cars">
            <?php 
                $cars = load_fullcars();
            
                foreach($cars as $car)
                {
            ?>
                      
            <div class="col-6" id="slow">
                <div class="card mb-3" align="center">
                    <h3 class="card-header"><?php echo $car['name']; ?></h3>
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $car['type']; ?></h5>
                </div>
                <img style="height: 400px; width: 100%;" src="<?php echo $car['picture']; ?>"/>
                <ul class="list-group list-group-flush" align="center">
                    <li class="list-group-item"><?php echo $car['vintage']; ?></li>
                    <li class="list-group-item"><?php echo $car['engine']; ?></li>
                    <li class="list-group-item"><?php echo $car['enginetype']; ?></li>
                    <li class="list-group-item"><?php echo $car['price']; ?></li>
                    <input type="button" name="add_to_cart" id="<?php echo $car['id']; ?>" class="btn btn-success add_to_cart" value="Buy Now!"></input>
                </ul>
                <div class="card">
                    <div class="card-body" id="descriptionField">
                    <h4 class="card-title">Description</h4>
                    <p class="card-text"></p>
                    </div>
                </div>         
            </div>
         </div>

            <?php 
                }
            ?>

</div>



<!-- // Popover content  -->


<?php include_once('views/footer.php') ?>

<!-- SCRIPT   -->
<script type="text/javascript">

$(document).ready(function(){

 
    
    $('#min_price').on("input change",function(){
        var price = $(this).val();       
        $('#range_value').html(price);

        $.ajax({
            url:"./functions/functions.php",
            method: "POST",
            data: {action: "loadCars", price: price},
            success:function(data)
            {
                $('#display_cars').fadeIn('slow').html(data);
            }
        });
    });


 

});

</script>




<!-- // DASHBOARD STYLE  -->

<style></style>
