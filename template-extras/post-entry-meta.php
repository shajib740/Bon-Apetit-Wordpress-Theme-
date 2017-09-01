<?php
/**
 * Created by PhpStorm.
 * User: TUSHAR
 * Date: 6/16/2017
 * Time: 12:59 PM
 */
?>

<ul class="list-inline">
    <li>
        <?php
        $year = get_the_date('Y');
        $month = get_the_date('m');
        $day = get_the_date('d');
        ?>
        <a class="meta-date-link" href="<?php echo get_day_link( $year, $month, $day );?>">
            <i class="fa fa-calendar meta-date-style" aria-hidden="true"></i>
            <?php echo get_the_date( 'F j, Y' );?>

        </a>
    </li>
    <li>
        <?php echo getPostLikeLink(get_the_ID());?>
    </li>
</ul>

