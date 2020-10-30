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

<?php include_once('views/profile.php') ?>

            <div class="row justify-content-center  filtersDiv">
                    <div class="col-sm-4 col-lg-8 col-md-3 mt-3 filter">
                        <span class="filtered">Brand:   <span class="manufacturer filter"></span></span>
                        <span class="filtered">Storage(GB): <span class="memorie filter"></span></span>
                        <span class="filtered">Ram(GB):     <span class="ram filter"></span></span>
                        <br>
                        <span class="filtered">Camera(MP):  <span class="camera filter"></span></span>
                        <span class="filtered">Color:   <span class="color filter"></span></span>
                        <span class="filtered">Display(INC): <span class="display filter"></span></span>
                        <span class="filtered">System:  <span class="system filter"></span></span>
                    </div>
            </div>
    
       <div class="row ml-2 w-100 phones">
            <div class="col-sm-2">

               
                    <div class="list-group">
                    <span class="title">Brand</span>
                        <?php $manufacturers = display_checkboxes("manufacturer"); 
                            foreach ($manufacturers as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector manufacturer"  value="<?php echo $row['manufacturer']; ?>"> <?php echo $row['manufacturer']; ?></label>
                        </div>
                        <?php
                            } 
                        ?>
                    </div>
                

                
                    <div class="list-group">
                    <hr class="hr" align=left>
                    <span class="title">Storage</span>
                    <?php $memorie = display_checkboxes("memorie"); 
                            foreach ($memorie as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector memorie"  value="<?php echo $row['memorie']; ?>"> <?php echo $row['memorie']; ?> GB</label>
                        </div>
                        <?php
                            } 
                        ?> 
                    </div>
                

                
                    <div class="list-group">
                    <hr class="hr" align=left>
                    <span class="title">Ram</span>
                    <?php $ram = display_checkboxes("ram"); 
                            foreach ($ram as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector ram"  value="<?php echo $row['ram']; ?>"> <?php echo $row['ram']; ?> GB</label>
                        </div>
                        <?php
                            } 
                        ?>
                    </div>
                
                    <div class="list-group">
                    <hr class="hr" align=left>
                    <span class="title">Camera</span>
                    <?php $camera = display_checkboxes("camera"); 
                            foreach ($camera as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector camera"  value="<?php echo $row['camera']; ?>"> <?php echo $row['camera']; ?> MP</label>
                        </div>
                        <?php
                            } 
                        ?>
                    </div>
                
                    <div class="list-group">
                    <hr class="hr" align=left>
                    <span class="title">Color</span>
                    <?php $color = display_checkboxes("color"); 
                            foreach ($color as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector color"  value="<?php echo $row['color']; ?>"> <?php echo $row['color']; ?></label>
                        </div>
                        <?php
                            } 
                        ?>
                    </div>
                

               
                    <div class="list-group">
                    <hr class="hr" align=left>
                    <span class="title">Display</span>
                    <?php $display = display_checkboxes("display"); 
                            foreach ($display as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector display"  value="<?php echo $row['display']; ?>"> <?php echo $row['display']; ?> INC</label>
                        </div>
                        <?php
                            } 
                        ?>
                    </div>
                

                
                    <div class="list-group">
                    <hr class="hr" align=left>
                    <span class="title">System</span>
                    <?php $system = display_checkboxes("system"); 
                            foreach ($system as $row)
                            {
                        ?>
                        <div class="list-group-item checkbox" style="width:150px; border:1px solid black;border-radius: 20px;">
                            <label><input type="checkbox" class="common_selector system"  value="<?php echo $row['system']; ?>"> <?php echo $row['system']; ?></label>
                        </div>
                        <?php
                            } 
                        ?>
                    </div>


               

            </div>

            

            <div class="col-md-9 mt-3" style="border:1px solid black;">
                <br />
                           
                    <div class="row filter_data">

                    </div>
                    <div class="row d-flex justify-content-center pagination_row mt-5">
                        <div class="pagination"></div>
                    </div>
                
            </div>
            
            
        </div>
    
        <div id="loading" style="" ></div>

    

<?php include_once('views/footer.php') ?>


<!-- *****  PHONES SCRIPT  ********-->

<script type="text/javascript">

$(document).ready(function(){

    var page;

    loadPhones();

    function loadPhones ()
    {
        $('filter_data').html('<div id="loading" style="" ></div>');

        var manufacturer = chekboxValue('manufacturer');
        var memorie = chekboxValue('memorie');
        var ram = chekboxValue('ram');
        var camera = chekboxValue('camera');
        var color = chekboxValue('color');
        var display = chekboxValue('display');
        var system = chekboxValue('system');
       
        
        
            var manu = `manufacturer: ${manufacturer}`;
            var memo = `memorie: ${memorie} GB`;
        
        $('.manufacturer').text(manufacturer);
        $('.memorie').text(memorie);
        $('.ram').text(ram);
        $('.camera').text(camera);
        $('.color').text(color);
        $('.display').text(display);
        $('.system').text(system);
        

        $.ajax({
            url:"./functions/functions.php",
            method: "POST",
            dataType: "json",
            data: {action: "loadPhones", manufacturer: manufacturer, memorie: memorie, ram: ram, camera: camera,
                   color: color, display: display, system: system, page: page},
            success:function(data)
            {                    
                $('.filter_data').html(data.phones);
                $('.pagination').html(data.pagination);
                page=1;               
            }
        });
    }
    
    
    function chekboxValue(class_name)
    {
        let checkedBoxes = [];
        $("."+class_name+":checked").each(function(){
        checkedBoxes.push($(this).val());
    });
        return checkedBoxes;
    }



    $(document).on('click', '.pagi_selector', function(){
        page = $(this).attr('id');
        loadPhones();
    });

    
        
    
      $('.common_selector').click(function(){
          let boxes = chekboxValue('common_selector');
          console.log(boxes);
          let option = $(this).prop("classList")[1];
          console.log(option);
          
         loadPhones();
      });
    
   

});


    






</script>




<!-- *****  PHONES STYLE  ********-->

<style>
.title {
    font-size: 30px;
    color: #03e3fc;
}
.hr {
    width: 160px;
    height: 1px;
    background-color:black;
    border:0px;
}
.pagination_row {
    width: 100%;  
}

#loading {
    text-align:center; 
    background: url("./assets/loading.gif") no-repeat center; 
   
}
.filtersDiv {
    height:80px;
    font-size: 20px;
    font-weight: bold;
}

.filtered {
    margin-left: 40px;
    color: #03e3fc;
    
}
.filter {
    color: black;
}

</style>


