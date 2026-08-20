<?php
/**
 * Template Name: Blog Übersichtsseite
 * Template Post Type: page
 * 
 * Description: Modern Dark-Teal Blog Archive Template for odooservice.de
 * Language: Deutsch (de_DE)
 */

get_header();
?>

<main id="primary" class="site-main odooservice-blog-archive">
    <!-- Hero Section -->
    <section class="blog-hero">
        <div class="blog-container">
            <span class="blog-badge">Wissen & Einblicke</span>
            <h1 class="blog-hero-title">Odoo ERP Ratgeber & Insights</h1>
            <p class="blog-hero-subtitle">
                Praxisnahe Leitfäden, Experten-Tipps und Best Practices rund um Odoo Implementierung, Migration, Modulentwicklung und Prozessautomatisierung für den Mittelstand.
            </p>
            
            <!-- Category Filter Pills -->
            <div class="blog-categories">
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="cat-pill active">Alle Artikel</a>
                <?php
                $categories = get_categories( array( 'hide_empty' => false ) );
                foreach ( $categories as $cat ) {
                    if ( 'Uncategorized' === $cat->name || 'Allgemein' === $cat->name ) {
                        continue;
                    }
                    echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="cat-pill">' . esc_html( $cat->name ) . '</a>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="blog-grid-section">
        <div class="blog-container">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $blog_query = new WP_Query( array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 9,
                'paged'          => $paged,
            ) );

            if ( $blog_query->have_posts() ) :
                echo '<div class="blog-grid">';
                while ( $blog_query->have_posts() ) :
                    $blog_query->the_post();
                    $reading_time = function_exists( 'odooservice_reading_time' ) ? odooservice_reading_time( get_the_ID() ) : '6 Min. Lesezeit';
                    $post_cats = get_the_category();
                    $primary_cat = ! empty( $post_cats ) ? $post_cats[0]->name : 'Odoo ERP';
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>
                        <div class="blog-card-media">
                            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) ); ?>
                                <?php else : ?>
                                    <div class="blog-card-placeholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#B8FF29" stroke-width="1.5">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <span class="blog-card-badge"><?php echo esc_html( $primary_cat ); ?></span>
                        </div>

                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <span class="meta-date"><?php echo get_the_date( 'd. F Y' ); ?></span>
                                <span class="meta-separator">•</span>
                                <span class="meta-reading-time"><?php echo esc_html( $reading_time ); ?></span>
                            </div>

                            <h2 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <p class="blog-card-excerpt">
                                <?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?>
                            </p>

                            <div class="blog-card-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    Artikel lesen
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php
                endwhile;
                echo '</div>';

                // Pagination
                if ( $blog_query->max_num_pages > 1 ) :
                    echo '<div class="blog-pagination">';
                    echo paginate_links( array(
                        'total'     => $blog_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '&larr; Zurück',
                        'next_text' => 'Weiter &rarr;',
                    ) );
                    echo '</div>';
                endif;

                wp_reset_postdata();
            else :
                ?>
                <div class="blog-empty">
                    <h2>Aktuell werden neue Artikel vorbereitet.</h2>
                    <p>Schauen Sie in Kürze wieder vorbei oder abonnieren Sie unsere Updates.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Bottom Conversion CTA -->
    <section class="blog-cta-section">
        <div class="blog-container">
            <div class="blog-cta-card">
                <span class="cta-badge">Kostenlose Erstberatung</span>
                <h2>Planen Sie eine Odoo Implementierung oder Migration?</h2>
                <p>
                    Lassen Sie uns unverbindlich über Ihre Anforderungen sprechen. Unsere Odoo Experten analysieren Ihre Prozesse und erstellen eine maßgeschneiderte Roadmap.
                </p>
                <div class="blog-cta-actions">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-primary-neon">
                        Jetzt Erstgespräch anfragen
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/odoo-dienstleistungen/' ) ); ?>" class="btn-secondary-ghost">
                        Unsere Leistungen entdecken
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
