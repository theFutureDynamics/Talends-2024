<?php global $lstCurrentListings; ?>
<div class="listivo-listing-grid listivo-listing-grid--rows-v2 listivo-listing-grid--1-col">
    <?php
    global $lstCurrentListing;
    foreach ($lstCurrentListings as $lstCurrentListing) : ?>
        <?php get_template_part('templates/partials/card/listing_row_v2'); ?>
    <?php endforeach; ?>
</div>