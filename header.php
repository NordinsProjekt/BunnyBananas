<?php

$userCtrl = new UserController();
$cartCtrl = new CartController();
$prodCtrl = new ProductController();

?>
<header class="header">

    <nav class="flex-row">
        <?php
        if (isset($_SESSION['is_logged_in'])) 
        {
            echo LogoutForm();
            echo "<a class='LinkHeader' href='./profile'>Profil</a>";
            if ($userCtrl->VerifyUserAdmin()) {

                echo "<a class='LinkHeader' href='./admin'>Adminpanelen</a>";
            }
        }
        else 
        {
            echo "<div class='LoginFlex'>";
            echo LoginForm();
            echo "</div>";
        }
        ?>
    </nav>

    <a href="./"><img src="img/sinus-logo-portrait - small.png"></a>

    <nav>
        
        <div class="flex-row" style="justify-content: space-between;">   
            
            <div class="flex-row">
                <p style="margin-left: 10px;"><b><?php echo currency($cartCtrl->CurrentSum()); ?></b> (<?php echo $cartCtrl->CurrentAmountOfItems(); ?>)</p>
                <form action="#" method="post">
                    <input type="submit" name="currency" class="currency" value="SEK" /> /
                    <input type="submit" name="currency" class="currency" value="EUR" />
                </form>
            </div>
            <a class='LinkHeader' href="./cart" style="margin-right: 10px;">Kundkorg</a>
        </div>
        <div class="flex-row" style="justify-content: flex-end;">
            <form method="GET" action="./search" style="margin:0;">
                <div class="flex-row">
                    <input type="submit" value="Sök" name="search">
                    <input type="text" name="searchCriteria" placeholder="Search..">
                </div>
                <div class="flex-row">
                    <div class="">
                        <a href="#" onclick="dropDown('category')" class="dropdown-label" style="margin-left:5px;"><img id="dropDownCategoryArrow" src="img/arrow.png" height="12px" style="padding-bottom:1px;"> Kategori</a>
                        <div id="dropDownCategory" class="dropdown-content">
                            <?php foreach ($prodCtrl->listAllCategories() as $row){?>
                                <input type="checkbox" id="<?php echo $row['ID']?>" name="category[]" value="<?php echo $row['ID']?>"><label for="<?php echo $row['ID']?>"><?php echo $row['Name']?></label><br>
                            <?php } //END FOREACH?>
                        </div>
                    </div>

                    <div class="">
                        <a href="#" onclick="dropDown('color')" class="dropdown-label"><img id="dropDownColorArrow" src="img/arrow.png" height="12px" style="padding-bottom:1px;"> Färg</a>
                        <div id="dropDownColor" class="dropdown-content">
                            <?php foreach ($prodCtrl->listAllColors() as $row){?>
                                <input type="checkbox" id="<?php echo $row['ID']?>" name="color[]" value="<?php echo $row['ID']?>"><label for="<?php echo $row['ID']?>"><?php echo $row['Name']?></label><br>
                            <?php } //END FOREACH?>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</header>