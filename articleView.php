<?php
if (!empty($resultActicle)) :
    ?>
    <ul>
        <li class="article">
            <?php
            if (!empty($resultActicle['image'])) {
                echo '<div class="articleImage"><img src="'.$resultActicle['image'].'" /></div>';
            }
            ?>
            <div class="articleTitle"><h3>
                    <?php
                    echo ($resultActicle['header']);
                    if ($_SESSION['isAdmin']) {
                        echo '<a href="/createArticle.php?articleId='.$resultActicle['id'] . '">--------редактировать</a>';
                    }
                    ?>
                </h3></div>
            <div class="articleBody">
                <?php
                echo $resultActicle['text'];
                ?>
            </div>
        </li>
    </ul>
<?php endif ?>