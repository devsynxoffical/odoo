<?php
/**
 * Plugin Name: Odoo Service On-Page SEO Engine
 * Description: Automates Rank Math SEO Metadata, German Focus Keywords, Schema Markup and Image ALT Tags for odooservice.de.
 * Version: 1.0.0
 * Author: Odoo Service Team
 * Language: Deutsch (de_DE)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OdooService_SEO_Engine {

    private static $seo_pages = array(
        10 => array(
            'slug'          => 'home-page',
            'title'         => 'Odoo Agentur Deutschland | Implementierung, Beratung & Migration',
            'description'   => 'Ihre führende Odoo Agentur für Implementierung, Beratung & Migration. Maßgeschneiderte Odoo ERP-Lösungen für maximale Effizienz. Jetzt Erstgespräch anfragen!',
            'focus_keyword' => 'Odoo Agentur,Odoo Implementierung,Odoo Beratung Deutschland,Odoo ERP Partner,Odoo Migration,ERP System Einführung KMU',
            'canonical'     => 'https://odooservice.de/',
        ),
        17 => array(
            'slug'          => 'odoo-dienstleistungen',
            'title'         => 'Odoo Dienstleistungen & Services: Beratung, Entwicklung & Support',
            'description'   => 'Entdecken Sie unsere Odoo Dienstleistungen: ERP-Implementierung, JTL-Migration, Modulentwicklung, API-Schnittstellen & Support. Individuell für Ihr Business.',
            'focus_keyword' => 'Odoo Dienstleistungen,Odoo Services,Odoo ERP Entwicklung,Odoo Modulanpassung,Odoo JTL Migration,Odoo Schnittstellen API,Odoo Support Wartung',
            'canonical'     => 'https://odooservice.de/odoo-dienstleistungen/',
        ),
        21 => array(
            'slug'          => 'about-us',
            'title'         => 'Odoo Partner & Experten | Über Odoo Service & unser Team',
            'description'   => 'Lernen Sie Odoo Service kennen: Ihr erfahrener Odoo Partner für ganzheitliche ERP-Lösungen im DACH-Raum. Persönliche Beratung, technisches Know-how & Erfolg.',
            'focus_keyword' => 'Odoo Partner Deutschland,Odoo Experten Team,Odoo Spezialisten,Odoo Beratung DACH,Odoo Agentur Erfahrung',
            'canonical'     => 'https://odooservice.de/about-us/',
        ),
        25 => array(
            'slug'          => 'contact',
            'title'         => 'Odoo Beratung & Kontakt | Kostenloses Erstgespräch anfragen',
            'description'   => 'Starten Sie Ihr Odoo Projekt mit Odoo Service. Vereinbaren Sie jetzt ein unverbindliches Erstgespräch für Implementierung, Migration oder Support.',
            'focus_keyword' => 'Odoo Beratung Kontakt,Odoo Erstgespräch anfragen,Odoo Agentur Kontakt,Odoo Experte anfragen,Odoo Projektberatung',
            'canonical'     => 'https://odooservice.de/contact/',
        ),
        688 => array(
            'slug'          => 'references-page',
            'title'         => 'Odoo Referenzen & Case Studies | Erfolgreiche Kundenprojekte',
            'description'   => 'Erfolgreiche Odoo Projekte & Kundenreferenzen: Von der JTL-Migration bis zur ERP-Komplettlösung für Großhandel, Retail und Fertigung. Jetzt Case Studies lesen!',
            'focus_keyword' => 'Odoo Referenzen,Odoo Projekte,Odoo Erfolgsgeschichten,Odoo Case Studies,JTL zu Odoo Migration Referenz,Odoo Einführung Großhandel',
            'canonical'     => 'https://odooservice.de/references-page/',
        ),
        836 => array(
            'slug'          => 'impressum',
            'title'         => 'Impressum | Odoo Service Rechtliche Angaben',
            'description'   => 'Impressum von Odoo Service: Rechtliche Angaben, Unternehmensinformationen, Registernummern und Kontaktdaten.',
            'focus_keyword' => 'Odoo Service Impressum',
            'canonical'     => 'https://odooservice.de/impressum/',
        ),
        881 => array(
            'slug'          => 'geschaftsbedingun',
            'title'         => 'Allgemeine Geschäftsbedingungen (AGB) | Odoo Service',
            'description'   => 'Allgemeine Geschäftsbedingungen von Odoo Service: Informationen zu Leistungen, Vergütung, Verträgen und Datenschutz.',
            'focus_keyword' => 'Odoo Service AGB',
            'canonical'     => 'https://odooservice.de/geschaftsbedingun/',
        ),
        3 => array(
            'slug'          => 'privacy-policy',
            'title'         => 'Datenschutzerklärung | Odoo Service DSGVO-Konform',
            'description'   => 'Datenschutzerklärung von Odoo Service: Erfahren Sie alles über den Schutz und die Verarbeitung Ihrer personenbezogenen Daten gemäß DSGVO.',
            'focus_keyword' => 'Odoo Service Datenschutz',
            'canonical'     => 'https://odooservice.de/privacy-policy/',
        ),
        1723 => array(
            'slug'          => 'cookie-policy',
            'title'         => 'Cookie-Richtlinie | Odoo Service Hinweise zu Cookies',
            'description'   => 'Informationen über die Verwendung von Cookies und ähnlichen Technologien auf der Website von Odoo Service.',
            'focus_keyword' => 'Odoo Service Cookie Richtlinie',
            'canonical'     => 'https://odooservice.de/cookie-policy/',
        ),
    );

    public static function init() {
        add_filter( 'rank_math/frontend/title', array( __CLASS__, 'filter_rank_math_title' ), 99 );
        add_filter( 'rank_math/frontend/description', array( __CLASS__, 'filter_rank_math_description' ), 99 );
        add_filter( 'rank_math/frontend/canonical', array( __CLASS__, 'filter_rank_math_canonical' ), 99 );
        add_action( 'init', array( __CLASS__, 'sync_seo_meta_once' ) );
    }

    /**
     * Filter Rank Math title dynamically in German
     */
    public static function filter_rank_math_title( $title ) {
        $post_id = get_queried_object_id();
        if ( is_front_page() || ( is_page() && 'home-page' === get_post_field( 'post_name', $post_id ) ) ) {
            return self::$seo_pages[10]['title'];
        }
        if ( isset( self::$seo_pages[ $post_id ] ) ) {
            return self::$seo_pages[ $post_id ]['title'];
        }
        return $title;
    }

    /**
     * Filter Rank Math description dynamically in German
     */
    public static function filter_rank_math_description( $desc ) {
        $post_id = get_queried_object_id();
        if ( is_front_page() || ( is_page() && 'home-page' === get_post_field( 'post_name', $post_id ) ) ) {
            return self::$seo_pages[10]['description'];
        }
        if ( isset( self::$seo_pages[ $post_id ] ) ) {
            return self::$seo_pages[ $post_id ]['description'];
        }
        return $desc;
    }

    /**
     * Filter Rank Math canonical dynamically
     */
    public static function filter_rank_math_canonical( $canonical ) {
        $post_id = get_queried_object_id();
        if ( is_front_page() ) {
            return self::$seo_pages[10]['canonical'];
        }
        if ( isset( self::$seo_pages[ $post_id ] ) ) {
            return self::$seo_pages[ $post_id ]['canonical'];
        }
        return $canonical;
    }

    /**
     * Synchronize postmeta records once to database
     */
    public static function sync_seo_meta_once() {
        if ( get_option( 'odooservice_seo_meta_synced_v1' ) ) {
            return;
        }

        foreach ( self::$seo_pages as $pid => $data ) {
            update_post_meta( $pid, 'rank_math_title', $data['title'] );
            update_post_meta( $pid, 'rank_math_description', $data['description'] );
            update_post_meta( $pid, 'rank_math_focus_keyword', $data['focus_keyword'] );
            update_post_meta( $pid, 'rank_math_canonical_url', $data['canonical'] );
            update_post_meta( $pid, 'rank_math_facebook_title', $data['title'] );
            update_post_meta( $pid, 'rank_math_facebook_description', $data['description'] );
            update_post_meta( $pid, 'rank_math_twitter_title', $data['title'] );
            update_post_meta( $pid, 'rank_math_twitter_description', $data['description'] );
            update_post_meta( $pid, 'rank_math_twitter_use_facebook', 'off' );
            update_post_meta( $pid, 'rank_math_robots', array( 'index' ) );
        }

        update_option( 'odooservice_seo_meta_synced_v1', 1 );
    }
}

OdooService_SEO_Engine::init();
