<?php while (have_posts()) : the_post(); ?>
<!-- VISUAL -->
<div class="main-visual">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                    <div class="row-flex">
                        <section class="vcard">
                            <a href="<?php echo home_url('/') ?>strengths/childcare/" class="vcard-anc vcard-anc--nursery">
                                <div class="vcard-meta vcard-meta--nursery">
                                    <h1>保育士留学</h1>
                                    <p>自由と個性を尊重する<br class="br-sp">
                                    カナダから、理想の保育士へ</p>
                                </div>
                            </a>
                        </section>
                        <section class="vcard">
                            <a href="<?php echo home_url('/') ?>strengths/oyakoryugaku/" class="vcard-anc vcard-anc--parents">
                                <div class="vcard-meta vcard-meta--parents">
                                    <h1>親子留学</h1>
                                    <p>お子様の幼少期を<br class="br-sp">
グローバルに</p>
                                </div>
                            </a>
                        </section>
                        <section class="vcard">
                            <a href="<?php echo home_url('/') ?>strengths/it_web/" class="vcard-anc vcard-anc--it">
                                <div class="vcard-meta vcard-meta--it">
                                    <h1>IT/クリエイティブ留学</h1>
                                    <p>世界で通用する<br class="br-sp">
クリエイターに</p>
                                </div>
                            </a>
                        </section>
                    </div>

            </div>
            <div class="col-sm-4">
                <section class="mv-support">
                    <div class="inner">
                        <h1>專門留学サポート</h1>
                        <p>私達は留学後まで視野に入れた專門留学を皆様にお届けします。</p>
                        <ul class="mv-support-btnlist">
                            <li class="btn btn-grey btn--arrow"><a href="<?php echo home_url('/') ?>support/before/"><i class="icon-arrow icon-arrow--white" aria-hidden="true"></i>留学前</a></li>
                            <li class="btn btn-grey btn--arrow"><a href="<?php echo home_url('/') ?>support/abroad/"><i class="icon-arrow icon-arrow--white" aria-hidden="true"></i>留学中</a></li>
                            <li class="btn btn-grey btn--arrow"><a href="<?php echo home_url('/') ?>support/after/"><i class="icon-arrow icon-arrow--white" aria-hidden="true"></i>留学後</a></li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- /VISUAL -->

<?php get_template_part('templates/gnav'); ?>

<!-- NEWS -->
<div class="container">
    <div class="row-flex--spacebetween row-flex--news">
        <section class="news-box">
            <h1>最新情報</h1>
            <div class="btn-link"><a href="<?php echo home_url('/') ?>news/"><i class="icon-arrow" aria-hidden="true"></i>一覧を見る</a></div>
            <dl class="news-box-dl">
			<?php
			  $loop = new WP_Query(array(
			    "post_type" => "post",
			    'posts_per_page' => 4,
			  ));
			  if ( $loop->have_posts() ) : while($loop->have_posts()): $loop->the_post();
			?>
            	<dt><time datetime="<?php echo get_post_time(DATE_RFC3339); ?>"><?php echo get_post_time('Y/m/d'); ?></time></dt>
                <dd><p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></dd>
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
            </dl>
        </section>
        <section class="bnr-box">
            <ul class="bnr-box-list">
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/dist/images/bnr01_blog.png"></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/dist/images/bnr02_blog.png"></a></li>
            </ul>
        </section>
    </div>
</div>
<!-- /NEWS -->

<!-- EXPERT -->
<div class="expert-area">
    <div class="container">
        <section class="expert-box center-block col1-section">
            <h1>専門留学とは</h1>
            <ol class="expert-list">
                <li class="expert-item">
                    <div class="expert-item--step">step <span class="expert-item--number">1</span></div>
                    <div class="expert-item--title">留学準備<div class="expert-item--des">計画  ビザ申請など</div></div>
                    
                    <div class="expert-item--icon"><i class="icon-passport" aria-hidden="true"></i></div>
                </li>
                <li class="expert-item">
                    <div class="expert-item--step">step <span class="expert-item--number">2</span></div>
                    <div class="expert-item--title">英語を学ぶ<div class="expert-item--des">現地の語学学校</div></div>
                    
                    <div class="expert-item--icon"><i class="icon-school" aria-hidden="true"></i></div>
                </li>
                <li class="expert-item expert-item__green">
                    <div class="expert-item--step">step <span class="expert-item--number">3</span></div>
                    <div class="expert-item--title">スキルを磨く<div class="expert-item--des">現地の専門学校</div></div>
                    
                    <div class="expert-item--icon"><i class="icon-skill" aria-hidden="true"></i></div>
                </li>
                <li class="expert-item expert-item__green">
                    <div class="expert-item--step">step <span class="expert-item--number">4</span></div>
                    <div class="expert-item--title">技術を活かして働く<div class="expert-item--des">現地の仕事</div></div>
                    
                    <div class="expert-item--icon"><i class="icon-work" aria-hidden="true"></i></div>
                </li>
            </ol>
            <div class="expert-subtitle"><p>自分に合ったキャリアに向かってステップアップ</p></div>
            <div class="expert-des">
                <p>世の中で最も一般的な留学は『語学留学』かと思われますが、基本的に語学留学ではキャリアアップに繋げる事は非常に難しいです。<br>
    『語学』はあくまでも『ツール』であるという事は周知の事実かと思われますが<br>
    私達COSは、皆様にそのツールを用いて、その国で通用するだけの専門性を兼ね備えた留学プランとサポートをご提供しています。<br>
    各専門分野、業界におけるスペシャリストと蜜なコミュニケーションを行い、私達は『タダの留学』では無い、アナタのキャリアを確実に前に進めるための『専門留学』をサポート致します。</p>
            </div>
            <ul class="expert-btn">
                <li class="btn btn-green"><a href="<?php echo home_url('/') ?>strengths/">専門留学について</a></li>
                <li class="btn btn-green"><a href="<?php echo home_url('/') ?>contact/">まずはご相談</a></li>
            </ul>
        </section>
    </div>
</div>
<!-- /EXPERT -->


<!-- PLAN -->
<div class="plan-area">
    <div class="container">
        <section class="col1-section">
            <h1>様々な専門留学プラン</h1>
            <ul class="plan-list">
                <li class="plan-item">
                    <div class="plan-box plan-box--nursery">
                        <a href="<?php echo home_url('/') ?>strengths/childcare/">保育留学</a>
                    </div>
                </li>
                <li class="plan-item">
                    <div class="plan-box plan-box--parents">
                        <a href="<?php echo home_url('/') ?>strengths/oyakoryugaku/">親子留学</a>
                    </div>
                </li>
                <li class="plan-item">
                    <div class="plan-box plan-box--it">
                        <a href="<?php echo home_url('/') ?>strengths/it_web/">IT／クリエイティブ留学</a>
                    </div>
                </li>
                <li class="plan-item">
                    <div class="plan-box plan-box--phi">
                        <a href="<?php echo home_url('/') ?>">フィリピン留学</a>
                    </div>
                </li>
                <li class="plan-item">
                    <div class="plan-box plan-box--beauty">
                        <a href="<?php echo home_url('/') ?>strengths/beauty/">美容留学</a>
                    </div>
                </li>
                <li class="plan-item">
                    <div class="plan-box plan-box--school">
                        <a href="<?php echo home_url('/') ?>strengths/highschool/">高校留学</a>
                    </div>
                </li>
            </ul>
        </section>
    </div>
</div>
<!-- /PLAN -->

<!-- CONSULT -->
<div class="contact-area dot-bg hidden-xs">
    <div class="container">
        <section class="col1-section">
            <h1>無料留学相談</h1>
            <p class="contact-p">專門留学をご検討の方はお気軽にご相談ください</p>
            <div class="btn btn-blue btn--contact"><a href="<?php echo home_url('/') ?>contact/">無料相談</a></div>
        </section>
    </div>
</div>
<!-- /CONSULT -->

<!-- SUPPORT -->
<div class="support-area">
    <div class="container">
        <section class="col1-section">
            <h1>専門留学後のサポート</h1>
            <div class="row-flex--start card-list">
                <article class="card--sup">
                    <a href="<?php echo home_url('/') ?>after_support/pr/">
                        <div class="card-img">
                            <img src="<?php bloginfo('template_url'); ?>/dist/images/top_support_img01.png">
                        </div>
                        <div class="card-data">
                            <h1 class="card-data-title">永住権</h1>
                            <p class="card-data-txt">留学が終わり、カナダを拠点に更に活動の幅を広げるなら、永住権を目指すのは一つの道かもしれません。</p>
                        </div>
                    </a>
                    <ul class="card-extlinks">
                        <li><a href="<?php echo home_url('/') ?>strengths/manitoba/"><i class="icon-arrow--mini" aria-hidden="true"></i>マニトバ州で永住権</a></li>
                        <li><a href="<?php echo home_url('/') ?>strengths/yukon/"><i class="icon-arrow--mini" aria-hidden="true"></i>ユーコン州で永住権</a></li>
                    </ul>
                </article>
                <article class="card--sup">
                    <a href="<?php echo home_url('/') ?>after_support/job/">
                        <div class="card-img">
                            <img src="<?php bloginfo('template_url'); ?>/dist/images/top_support_img01.png">
                        </div>
                        <div class="card-data">
                            <h1 class="card-data-title">就労ビザ</h1>
                            <p class="card-data-txt">専門留学の利点の一つに、専門職はカナダも労働力として就労ビザの発行を比較的前向きに考えて貰えるという点にあります。</p>
                        </div>
                    </a>
                </article>
                <article class="card--sup">
                    <a href="<?php echo home_url('/') ?>after_support/japan/">
                        <div class="card-img">
                            <img src="<?php bloginfo('template_url'); ?>/dist/images/top_support_img01.png">
                        </div>
                        <div class="card-data">
                            <h1 class="card-data-title">日本帰国</h1>
                            <p class="card-data-txt">留学後に日本への帰国を考える時、専門職として就職の幅も大きく広がります。</p>
                        </div>
                    </a>
                </article>
            </div>
        </section>
    </div>
</div>
<!-- /SUPPORT -->

<?php endwhile; ?>
