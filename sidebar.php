<?php
// Display the Portfolio Widget
if (is_active_sidebar('sidebar-1')) {
    dynamic_sidebar('sidebar-1');
}
?>

<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'primary-sidebar' ); ?>
    </aside>
<?php endif; ?>

