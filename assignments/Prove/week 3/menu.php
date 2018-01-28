<!------------------------------------------------------------------
 * MENUE
 *   used w3 schools as a base
 *      https://www.w3schools.com/howto/howto_css_dropdown.asp 
---------------------------------------------------------------------->
<div class="menu">
    <div class="dropdown">
        <a href="index.php" class="homeLink"><button class="dropbtn">Products&#9660</button></a>
        <div class="dropdown-content">
            <a href="index.php#pizza">pizza</a>
            <a href="index.php#fries">fries</a>
            <a href="index.php#soda">soda</a>
        </div>
    </div>
    <a href="cart.php" style="text-decoration: none">
        <button class="cart" id="cartBtn">Cart <?php 
            if (isset($_SESSION["itemsLocations"]))
            {
                echo count($_SESSION["itemsLocations"]);
            }
            ?>
            
        </button>
    </a>
</div>
<div class="topBuffer"></div>
<!------------------------------------------------------------------
 * MENUE
 *   END
---------------------------------------------------------------------->
