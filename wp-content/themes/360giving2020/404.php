<?php get_header(); ?>
<div class="layout layout--single-column">
    <?php get_template_part('components/topbar'); ?>
    <?php get_template_part('components/header'); ?>
    <main class="layout__content">
        <section class="cards-section">
            <h1 class="cards-section__heading">Page not found</h1>
            <p class="cards-section__tagline">Please use the search form.</p>
        </section>
    </main>
    <?php get_template_part('components/footer'); ?>
</div>
<?php get_footer(); ?>