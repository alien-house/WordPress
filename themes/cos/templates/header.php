<!-- HEADER -->
<div class="header-wrap">
    <div class="container">
        <header class="header">
            <div class="row">
                <div class="col-sm-9">
                    <div class="header-box">
						<button class="btn-menu visible-xs">
							<svg version="1.1" id="btn-menu-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 17" style="enable-background:new 0 0 24 17;" xml:space="preserve">
								<path id="btn-menu-path" d="M0,14h24v3H0V14z M0,7h24v3H0V7z M0,0h24v3H0V0z"/>
							</svg>
						</button>
                        <?php if (is_front_page()): ?>
                            <h1 class="header-logo"><img src="<?php bloginfo('template_url'); ?>/dist/images/logo.png" alt=""></h1>
                        <?php else: ?>
                            <div class="header-logo"><a href="<?php echo home_url('/') ?>"><img src="<?php bloginfo('template_url'); ?>/dist/images/logo.png" alt=""></a></div>
                        <?php endif; ?>
                        <div class="header-des">
                            <p class="header-des-txt hidden-xs ">COSは専門留学を中心に、皆様のカナダ留学をサポートします</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="header-box">
                        <div class="btn btn-blue header-btn">
                        	<a href="<?php echo home_url('/') ?>contact/">無料留学相談<span class="hidden-xs">LINEでのご相談も受け付けております</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>
<!-- /HEADER -->


