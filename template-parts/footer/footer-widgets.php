<?php

if(is_active_sidebar('footer1')||
  is_active_sidebar('footer2')||
  is_active_sidebar('footer3')):?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 footer-widget-2">
                    <?php dynamic_sidebar( 'footer2' ); ?>
                </div>
                <div class="col-md-6 footer-widget-3">
                    <?php dynamic_sidebar( 'footer3' ); ?>

                </div>
            </div>
            
        </div>
        <div class="col-md-6 footer-widget-4">
                    <?php dynamic_sidebar( 'footer4' ); ?>

        </div>
    </div>
<?php endif;
   