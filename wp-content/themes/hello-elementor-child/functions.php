<?php
/**
 * Hello Elementor Child Theme - Functions & On-Page SEO Engine
 * 
 * Website: https://odooservice.de
 * Language: Deutsch (de_DE)
 * Author: Odoo Service
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue Child Theme Styles
 */
function hello_child_enqueue_styles() {
    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_uri(),
        array( 'hello-elementor' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'hello_child_enqueue_styles', 20 );

/**
 * =========================================================================
 * 1. TECHNICAL SEO & PERFORMANCE OPTIMIZATIONS
 * =========================================================================
 */

// DNS-Prefetch & Preconnect for performance & Core Web Vitals
function odooservice_seo_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'odooservice_seo_resource_hints', 10, 2 );

// Clean WP Head bloat for faster crawl speeds
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * =========================================================================
 * 2. STRUCTURED DATA / SCHEMA.ORG (JSON-LD) ENGINE (DEUTSCH)
 * =========================================================================
 */
function odooservice_output_structured_data() {
    if ( is_admin() ) {
        return;
    }

    $site_url  = home_url( '/' );
    $logo_url  = 'https://odooservice.de/wp-content/uploads/2026/06/cropped-ChatGPT-Image-Jun-24-2026-01_51_51-PM-1.png';
    
    // 1. Organization & ProfessionalService Schema
    $org_schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => array( 'Organization', 'ProfessionalService' ),
        '@id'             => $site_url . '#organization',
        'name'            => 'Odoo Service',
        'alternateName'   => 'Odoo Service Deutschland',
        'url'             => $site_url,
        'logo'            => array(
            '@type'   => 'ImageObject',
            'url'     => $logo_url,
            'caption' => 'Odoo Service Logo',
        ),
        'image'           => $logo_url,
        'description'     => 'Ihre führende Odoo Agentur für Implementierung, Beratung, Migration und maßgeschneiderte ERP-Entwicklung im DACH-Raum und weltweit.',
        'priceRange'      => '€€',
        'currenciesAccepted' => 'EUR',
        'paymentAccepted' => 'Rechnung, Überweisung',
        'areaServed'      => array(
            array(
                '@type' => 'Country',
                'name'  => 'Germany',
            ),
            array(
                '@type' => 'Country',
                'name'  => 'Austria',
            ),
            array(
                '@type' => 'Country',
                'name'  => 'Switzerland',
            ),
        ),
        'hasOfferCatalog' => array(
            '@type' => 'OfferCatalog',
            'name'  => 'Odoo ERP Dienstleistungen',
            'itemListElement' => array(
                array(
                    '@type'        => 'Offer',
                    'itemOffered'  => array(
                        '@type'       => 'Service',
                        'name'        => 'Odoo Implementierung & ERP Einführung',
                        'description' => 'Ganzheitliche Einführung und Konfiguration von Odoo ERP für Handel, Fertigung und Dienstleister.',
                    ),
                ),
                array(
                    '@type'        => 'Offer',
                    'itemOffered'  => array(
                        '@type'       => 'Service',
                        'name'        => 'Odoo Migration (z.B. JTL zu Odoo)',
                        'description' => 'Sichere Daten- und Prozessmigration von Altsystemen (JTL, Lexware, SAP) zu Odoo.',
                    ),
                ),
                array(
                    '@type'        => 'Offer',
                    'itemOffered'  => array(
                        '@type'       => 'Service',
                        'name'        => 'Odoo Beratung & Prozessoptimierung',
                        'description' => 'Strategische Beratung und Analyse zur Optimierung Ihrer Unternehmensprozesse.',
                    ),
                ),
                array(
                    '@type'        => 'Offer',
                    'itemOffered'  => array(
                        '@type'       => 'Service',
                        'name'        => 'Individuelle Odoo Modulentwicklung & API',
                        'description' => 'Programmierung maßgeschneiderter Module und Schnittstellen zu Drittsystemen.',
                    ),
                ),
                array(
                    '@type'        => 'Offer',
                    'itemOffered'  => array(
                        '@type'       => 'Service',
                        'name'        => 'Odoo Support, Wartung & Hosting',
                        'description' => 'Zuverlässige Betreuung, Updates und Monitoring für Ihr Odoo Produktivsystem.',
                    ),
                ),
            ),
        ),
        'contactPoint'    => array(
            '@type'             => 'ContactPoint',
            'contactType'       => 'customer service',
            'availableLanguage' => array( 'German', 'English' ),
            'url'               => $site_url . 'contact/',
        ),
    );

    // 2. WebSite Schema with SearchAction
    $website_schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        '@id'             => $site_url . '#website',
        'url'             => $site_url,
        'name'            => 'Odoo Service',
        'description'     => 'Odoo ERP Agentur für Beratung, Implementierung & Migration in Deutschland',
        'publisher'       => array(
            '@id' => $site_url . '#organization',
        ),
        'inLanguage'      => 'de-DE',
    );

    // Output Base Schemas
    echo '<script type="application/ld+json">' . wp_json_encode( $org_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    echo '<script type="application/ld+json">' . wp_json_encode( $website_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

    // 3. Page-Specific Schemas
    if ( is_front_page() || is_home() || ( is_page() && 'home-page' === get_post_field( 'post_name', get_the_ID() ) ) ) {
        // FAQ Schema for Front Page
        $faq_schema = array(
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array(
                array(
                    '@type'          => 'Question',
                    'name'           => 'Was kostet eine professionelle Odoo Implementierung?',
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => 'Die Kosten einer Odoo Einführung hängen von der Anzahl der Module, Datenmengen und individuellen Anpassungen ab. Bei Odoo Service bieten wir transparente Projektpakete und individuelle Angebote nach einer fundierten Bedarfsanalyse an.',
                    ),
                ),
                array(
                    '@type'          => 'Question',
                    'name'           => 'Wie läuft eine Migration von JTL oder einem anderen ERP-System zu Odoo ab?',
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => 'Unsere Experten analysieren Ihre bestehende Datenbank (Kunden, Produkte, Bestellungen, Lagerbestände), bereinigen die Daten und migrieren diese nahtlos in Odoo – ohne Betriebsunterbrechungen.',
                    ),
                ),
                array(
                    '@type'          => 'Question',
                    'name'           => 'Bietet Odoo Service auch laufenden Support und Wartung?',
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => 'Ja, wir bieten umfassenden Support mit definierten Reaktionszeiten, regelmäßigen Sicherheitsupdates, System-Monitoring und flexibler Entwickler-Unterstützung.',
                    ),
                ),
                array(
                    '@type'          => 'Question',
                    'name'           => 'Für welche Branchen und Unternehmensgrößen eignet sich Odoo?',
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => 'Odoo ist hochgradig modular und skaliert vom wachsenden Mittelstand (KMU) bis hin zu großen Industrieunternehmen in den Bereichen Großhandel, E-Commerce, Fertigung, Logistik und Dienstleistung.',
                    ),
                ),
            ),
        );
        echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }

    // 4. BreadcrumbList Schema for Subpages
    if ( is_page() && ! is_front_page() ) {
        $post_obj = get_queried_object();
        if ( $post_obj ) {
            $breadcrumbs_schema = array(
                '@context'        => 'https://schema.org',
                '@type'           => 'BreadcrumbList',
                'itemListElement' => array(
                    array(
                        '@type'    => 'ListItem',
                        'position' => 1,
                        'name'     => 'Startseite',
                        'item'     => $site_url,
                    ),
                    array(
                        '@type'    => 'ListItem',
                        'position' => 2,
                        'name'     => get_the_title( $post_obj ),
                        'item'     => get_permalink( $post_obj ),
                    ),
                ),
            );
            echo '<script type="application/ld+json">' . wp_json_encode( $breadcrumbs_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
        }
    }
}
add_action( 'wp_head', 'odooservice_output_structured_data', 2 );

/**
 * =========================================================================
 * 3. IMAGE ALT-TEXT AUTOMATION & ENHANCEMENT (DEUTSCH)
 * =========================================================================
 */
function odooservice_seo_image_alt_fallback( $attributes, $attachment, $size ) {
    if ( empty( $attributes['alt'] ) ) {
        $post_title = get_the_title( $attachment->ID );
        $clean_name = trim( preg_replace( '/[_-]+/', ' ', $post_title ) );
        
        // Clean out generic generated hash strings
        if ( preg_match( '/^[a-f0-9]{20,}/i', $clean_name ) || strlen( $clean_name ) < 3 ) {
            $clean_name = 'Odoo ERP Service Darstellung';
        }
        
        $attributes['alt'] = 'Odoo Service - ' . esc_attr( $clean_name );
    }
    return $attributes;
}
add_filter( 'wp_get_attachment_image_attributes', 'odooservice_seo_image_alt_fallback', 10, 3 );

/**
 * Auto-add alt attribute in content rendered if missing
 */
function odooservice_content_image_alt_enhancer( $content ) {
    if ( is_admin() ) {
        return $content;
    }
    
    // Replace empty alt="" or missing alt in <img> tags with context-rich German alt text
    $pattern = '/<img\s+([^>]*?)(\/?>)/i';
    return preg_replace_callback( $pattern, function( $matches ) {
        $img_tag = $matches[0];
        if ( ! preg_match( '/alt=["\']([^"\']+)["\']/i', $img_tag ) ) {
            // No alt attribute or empty alt
            if ( preg_match( '/alt=["\']\s*["\']/i', $img_tag ) ) {
                $img_tag = preg_replace( '/alt=["\']\s*["\']/i', 'alt="Odoo Service ERP Lösung"', $img_tag );
            } else {
                $img_tag = str_replace( '<img ', '<img alt="Odoo Service ERP Lösung" ', $img_tag );
            }
        }
        return $img_tag;
    }, $content );
}
add_filter( 'the_content', 'odooservice_content_image_alt_enhancer', 20 );

/**
 * =========================================================================
 * 4. OPEN GRAPH & SOCIAL METADATA FALLBACK (DEUTSCH)
 * =========================================================================
 */
function odooservice_social_meta_tags() {
    if ( is_admin() ) {
        return;
    }
    
    // Ensure German locale and essential meta fallback
    echo '<meta property="og:locale" content="de_DE" />' . "\n";
    echo '<meta property="og:site_name" content="Odoo Service" />' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
}
add_action( 'wp_head', 'odooservice_social_meta_tags', 5 );

/**
 * =========================================================================
 * 5. RANK MATH SEO FILTER HOOKS
 * =========================================================================
 */
// Ensure Rank Math defaults to German OpenGraph locale
add_filter( 'rank_math/opengraph/facebook/og_locale', function( $locale ) {
    return 'de_DE';
});

// Add company copyright to RSS feeds for content protection
add_filter( 'the_excerpt_rss', function( $content ) {
    return $content . ' <p>Quelle: <a href="' . esc_url( home_url( '/' ) ) . '">Odoo Service</a> - Ihr Odoo ERP Partner.</p>';
});