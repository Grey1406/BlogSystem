<div class="articles" >
<H2>Последние статьи</H2>
<?php if (!empty($resultArticlesOrderDate)) :
    ?>
    <ul>
    <?php foreach ($resultArticlesOrderDate as $item) :
        ?>
        <li class="article">
            <?php
            if (!empty($item['image'])) {
                echo '<div class="articleImage" ><img src="'.$item['image'].'" /></div>';
            }
            ?>
            <div class="articleTitle"><h3>
                    <?php
                    echo '<a href="/article.php?id='.$item['id'].'">'.$item['header'].'</a>';
                    ?>
                </h3></div>
            <div class="articleBody">
                <?php
                echo $item['text'];
                ?>
            </div>
        </li>
    <?php endforeach ?>


    </ul>
<?php endif ?>


</div>

<div class="topArticles">
<H2>Горячие статьи</H2>
<?php if (!empty($resultTopArticles)) :
    ?>
    <ul>
    <?php foreach ($resultTopArticles as $item) :
        ?>
        <li class="article">
            <div class="articleTitle"><h3>
                    <?php
                    echo '<a href="/article.php?id='.$item['id'].'">'.$item['header'].'</a>';
                    ?>
                </h3></div>
        </li>
    <?php endforeach ?>
    </ul>
<?php endif ?>
</div>

