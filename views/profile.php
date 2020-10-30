<!-- Profile section  -->

<div class="container">
  <div class="row justify-content-between center userRow">
    <div class="col-sm data"><?php echo $user['Username'] ?> </div>
    <div class="col-sm data" ><?php echo $user['Email'] ?></div>
    <div class="col-sm data"><?php echo $user['Phone'] ?></div>
    <div class="col-sm data"><?php echo $user['Balance'] ?>&nbsp Ft </div>
    <div class="col-sm btn data"  title="Shopping Cart">
            <i class="fas fa-cart-arrow-down shoppingCart" id="cart-popover" data-placement="bottom">
            <span class="count"></span></i>
    </div>
  </div>
</div>

<!-- Popover content  -->
<div class="container" id="pop">
    <div id="popover_content_wrapper" style="display:none;">
        <span id="cart_details" ></span>
        <div align="right" class="buttons">
            <a href="javascript:void(0)" class="btn btn-success" id="check_out_cart">
            <span class="glyphicon glyphicon-shopping-cart"> Check out</span>
            </a>
            <a href="javascript:void(0)" class="btn btn-danger" id="clear_cart">
            <span class="glyphicon glyphicon-shopping-trash"> Clear</span>
            </a>
        </div>
    </div>
</div>

<style>
.data {
    border: 2px solid black;
    text-align:center;
    height: 50px;
    padding-top: 10px;
    margin: 10px;
    font-weight: bold;
}
.userRow {
    border: 2px solid black;
}
.shoppingCart {
    font-size: 30px;
    position:relative;
    z-index:999;
    cursor:pointer
}
.count {
    width: 20px;
    height: 25px;
    position: absolute;
    background: white;
    bottom: 14px;
    font-size:23px;
}
.popover {
    width: 100%;
    max-height: 800px;
}
.cards {
    border:1px solid black; 
    padding: 12px; 
    margin-bottom:16px; 
    height:400px;
    
}
.cont {
    margin-left:13%;
}
.buyNow {
  background: indianred;
  font-weight: bold;
  cursor:pointer;
}
.offset {
  position: fixed;
  z-index:999;
  margin-left:10%;

}
.popover{
    max-width:1000px;
    max-height: 500px;
    overflow-y: auto;
}


</style>