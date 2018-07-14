<?php 
get_header(); ?>
<?php

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<header class="entry-header">
    	<div>
            <div>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
           	</div><!-- col -->
      	</div><!-- grid -->
	</header><!-- .entry-header -->

 	<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

 	<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>


 	<!-- Display the Post's content in a div box. -->

 	<div class="entry">
 		<?php the_content(); ?>
 	</div>


 	<!-- Display a comma separated list of the Post's Categories. -->

 	<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>
 	</div> <!-- closes the first div box -->


 	<!-- Stop The Loop (but note the "else:" - see next line). -->

 <?php endwhile; else : ?>


 	<!-- The very first "if" tested to see if there were any Posts to -->
 	<!-- display.  This "else" part tells what do if there weren't any. -->
 	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>


 	<!-- REALLY stop The Loop. -->

 <?php endif; 

 get_footer();
 ?>