
<!-- GLOBAL NAVIGATION -->
<nav class="gnav">
    <button class="btn-close visible-xs">
        <svg version="1.1" id="btn-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
         y="0px" viewBox="0 0 23 23" xml:space="preserve">
    <path id="btn-close-path" d="M21.6,0L23,1.4L1.4,23L0,21.6L21.6,0z M1.4,0L23,21.6L21.6,23L0,1.4L1.4,0z"/>
    </svg>
    </button>
    <div class="container gnav-list-wrap">
        <h1 class="gnav-title visible-xs">メニュー</h1>
        <?php 
            wp_nav_menu(array(
                'theme_location' => 'primary_navigation',
                'container' => '',
                'container_class' => '',
                'menu_id' => '',
                'menu_class' => '',
                'fallback_cb' => 'no_menu',
                'walker' => new Cos_Walker()
            ));
         ?>
    </div>
</nav>
<!-- /GLOBAL NAVIGATION -->
