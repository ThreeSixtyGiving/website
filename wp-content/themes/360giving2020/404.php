<?php get_header(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <section class="cards-section">
            <h2 class="cards-section__heading">Page not found</h2>
            <h2 class="cards-section__tagline">Please use the search form.</h2>
        </section>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>