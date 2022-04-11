<?php 
function getCategoryMenu(){
    $category = new \App\Models\Category();
    $category = $category->getAllCategories();
    if ($category->count() > 0) {
        echo 
        '<li class="dropdown megamenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catagory<i class="fa flm fa-angle-down"></i></a>
            <ul class="dropdown-menu">';
        foreach ($category as $cat_info) {
            if ($cat_info->child_cats-> count() > 0) {
                ?>
                <li class="dropdown">
                    <a href="#"><?php echo $cat_info->title ?></a>
                    <ul class="dropdown-menu">                
                        <?php
                            foreach ($cat_info->child_cats as $children) {
                                ?>
                                <li>
                                <li>
                                    <a href="#"><?php echo $children->title ?></a></li>
                                </li>
                                <?php
                            } 
                        ?>           
                    </ul>
                </li>
                <?php              
            } else{
                echo '<li style="width: 250px"><a href="">'.$cat_info->title.'</a></li>';
            }
        }
        echo "</ul></li>";
    }
}

?>