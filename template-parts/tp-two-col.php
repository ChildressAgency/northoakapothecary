<?php

$overlay = get_sub_field_object( 'overlay' );
$overlay = $overlay['value'];
if( get_sub_field( 'has_popup' ) ){
    $popup = get_sub_field( 'popup' );
}
$popup_ID = rand( 1000, 9999 );
?>

<div class="section <?php if( get_sub_field( 'inset' ) ) echo 'section--inset'; ?>">
    <?php if( $overlay != 'none' ): ?><div class="overlay overlay--<?php echo $overlay; ?>"></div><?php endif; ?>
    <div class="container">
        <?php if( get_sub_field( 'section_heading' ) ): ?><h2 class="section__heading"><?php the_sub_field( 'section_heading' ); ?></h2><?php endif; ?>
        <div class="two-col">
            <div class="two-col__left">
                <?php the_sub_field( 'left_column' ); ?>
                <?php if( $popup && $popup['column'] ): ?>
                    <a href="#popup-<?php echo $popup_ID; ?>" class="btn btn-primary popup__trigger"><?php echo $popup['btn_label']; ?></a>
                <?php endif; ?>
            </div>
            <div class="two-col__right">
                <?php the_sub_field( 'right_column' ); ?>
                <?php if( $popup && !$popup['column'] ): ?>
                    <a href="#popup-<?php echo $popup_ID; ?>" class="btn btn-primary popup__trigger"><?php echo $popup['btn_label']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if( get_sub_field( 'has_popup' ) ): ?>
    <div id="popup-<?php echo $popup_ID; ?>" class="popup-wrapper">
        <div class="container">
            <div class="popup popup--two-col">
                <div class="popup__close"><i class="fas fa-times"></i></div>
                <div class="popup__content">
                    <?php if( $popup['image'] ): ?>
                        <img class="popup__image" src="<?php echo $popup['image']['url']; ?>" alt="<?php echo $popup['image']['alt']; ?>" />
                    <?php endif; ?>
                    <?php echo $popup['text']; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
