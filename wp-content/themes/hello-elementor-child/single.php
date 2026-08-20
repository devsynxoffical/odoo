<?php
/**
 * Single Post Template for Blog Articles
 * 
 * Description: Premium Dark-Teal Single Post Template for odooservice.de
 * Language: Deutsch (de_DE)
 */

get_header();

while ( have_posts() ) :
    the_post();
    $reading_time = function_exists( 'odooservice_reading_time' ) ? odooservice_reading_time( get_the_ID() ) : '6 Min. Lesezeit';
    $post_cats = get_the_category();
    $primary_cat = ! empty( $post_cats ) ? $post_cats[0]->name : 'Odoo ERP Ratgeber';
    ?>

    <!-- Reading Progress Bar -->
    <div id="reading-progress-bar" class="reading-progress" aria-hidden="true"></div>

    <main id="primary" class="site-main odooservice-single-article">
        <!-- Article Header -->
        <header class="article-header">
            <div class="article-container">
                <!-- Breadcrumbs -->
                <nav class="article-breadcrumbs" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Startseite</a>
                    <span class="crumb-sep">/</span>
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
                    <span class="crumb-sep">/</span>
                    <span class="crumb-current"><?php echo esc_html( wp_trim_words( get_the_title(), 6, '...' ) ); ?></span>
                </nav>

                <div class="article-badge"><?php echo esc_html( $primary_cat ); ?></div>
                <h1 class="article-title"><?php the_title(); ?></h1>

                <div class="article-meta-bar">
                    <div class="meta-author-info">
                        <div class="author-avatar">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#B8FF29" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div>
                            <span class="author-name">Odoo Service Expertenteam</span>
                            <span class="author-role">ERP & Prozessberater</span>
                        </div>
                    </div>

                    <div class="meta-details">
                        <span class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo get_the_date( 'd. F Y' ); ?>
                        </span>
                        <span class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo esc_html( $reading_time ); ?>
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Article Content Body -->
        <div class="article-container article-layout">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'article-body' ); ?>>
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="article-featured-image">
                        <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- Dynamic Content -->
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ( ! empty( $tags ) ) :
                    echo '<div class="article-tags-wrapper">';
                    echo '<span class="tags-title">Themen:</span> ';
                    foreach ( $tags as $tag ) {
                        echo '<span class="tag-pill">#' . esc_html( $tag->name ) . '</span> ';
                    }
                    echo '</div>';
                endif;
                ?>

                <!-- Author Box -->
                <div class="article-author-box">
                    <div class="author-box-avatar">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#B8FF29" stroke-width="1.8">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="author-box-content">
                        <h3>Über das Odoo Service Expertenteam</h3>
                        <p>
                            Als spezialisierte Odoo Agentur begleiten wir mittelständische Unternehmen und Großhändler im gesamten DACH-Raum bei der erfolgreichen Digitalisierung, Migration und Automatisierung mit Odoo ERP.
                        </p>
                        <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="author-link">Mehr über uns erfahren &rarr;</a>
                    </div>
                </div>

                <!-- Mid-Article / Post CTA -->
                <div class="article-inline-cta">
                    <div class="inline-cta-content">
                        <span class="cta-mini-badge">Kostenlose Projektanalyse</span>
                        <h3>Planen Sie die Einführung von Odoo ERP in Ihrem Unternehmen?</h3>
                        <p>
                            Sprechen Sie mit unseren zertifizierten Odoo Beratern über Machbarkeit, Zeitplan und Budget für Ihr Projekt.
                        </p>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-primary-neon">
                            Unverbindliches Erstgespräch vereinbaren &rarr;
                        </a>
                    </div>
                </div>

                <!-- Navigation between Posts -->
                <nav class="post-navigation" aria-label="Beitragsnavigation">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        if ( ! empty( $prev_post ) ) :
                            ?>
                            <div class="nav-previous">
                                <span class="nav-subtitle">&larr; Vorheriger Artikel</span>
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="nav-title">
                                    <?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php
                        $next_post = get_next_post();
                        if ( ! empty( $next_post ) ) :
                            ?>
                            <div class="nav-next">
                                <span class="nav-subtitle">Nächster Artikel &rarr;</span>
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="nav-title">
                                    <?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav>
            </article>

            <!-- Sticky Sidebar -->
            <aside class="article-sidebar">
                <div class="sidebar-sticky-widget">
                    <div class="sidebar-card consultation-card">
                        <span class="widget-badge">ERP Beratung</span>
                        <h4>Odoo Experten kontaktieren</h4>
                        <p>
                            Haben Sie Fragen zur Modulauswahl oder Schnittstellenanbindung? Wir unterstützen Sie gerne persönlich.
                        </p>
                        <ul class="sidebar-checklist">
                            <li>✓ Unverbindliche Erstberatung</li>
                            <li>✓ Transparente Aufwandsschätzung</li>
                            <li>✓ Schnelle Reaktionszeiten</li>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-primary-neon btn-block">
                            Jetzt anfragen
                        </a>
                    </div>

                    <div class="sidebar-card navigation-card">
                        <h4>Unsere Leistungen</h4>
                        <ul class="sidebar-links-list">
                            <li><a href="<?php echo esc_url( home_url( '/odoo-dienstleistungen/' ) ); ?>">Odoo Implementierung</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/odoo-dienstleistungen/' ) ); ?>">JTL zu Odoo Migration</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/odoo-dienstleistungen/' ) ); ?>">Odoo Modulentwicklung</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/odoo-dienstleistungen/' ) ); ?>">Support & Wartung</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/references-page/' ) ); ?>">Kundenreferenzen & Case Studies</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reading Progress Indicator
        const progressBar = document.getElementById('reading-progress-bar');
        if (progressBar) {
            window.addEventListener('scroll', function() {
                const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (totalHeight > 0) {
                    const progress = (window.pageYOffset / totalHeight) * 100;
                    progressBar.style.width = progress + '%';
                }
            });
        }
    });
    </script>

<?php
endwhile;

get_footer();
