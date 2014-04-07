<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
    <title><?php wp_title('-', true, 'right'); echo esc_html(get_bloginfo('name'), 1) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="Language" content="Deutsch" />
    <meta name="generator" content="Web-Baukasten der Friedrich-Alexander-Universit&auml;t (09/2009)" />

    <link rel="bookmark" href="http://www.uni-erlangen.de" title="Offizieller Webauftritt der Universit&auml;t Erlangen-N&uuml;rnberg" />
    <link rel="bookmark" href="http://www.portal.uni-erlangen.de" title="Uniportal Erlangen-N&uuml;rnberg" />
    <link rel="bookmark" href="http://www.rrze.uni-erlangen.de" title="RRZE" />
    <link rel="bookmark" href="http://univis.uni-erlangen.de" title="UnivIS" />

    <link rel="contents" href="/inhaltsuebersicht.shtml" title="Inhalts&uuml;bersicht" />
    <link rel="copyright" href="/impressum.shtml" title="Impressum" />
    <link rel="glossary" href="/glossar.shtml" title="&Uuml;bersicht aller Akronyme und Abk&uuml;rzungen" />
    <link rel="help" href="/hilfe.shtml" title="Hilfe, Kontaktm&ouml;glichkeiten und hilfreiche Informationen" />
    <link rel="start" href="/" title="Startseite" />

    <link rel="section" href="#content" media="handheld" title="Zum Inhalt" />
    <link rel="section" href="#leftnavi" media="handheld" title="Zur Navigation" />
    <link rel="section" href="#seitenanfang" media="handheld" title="Zum Seitenanfang" />
    <!-- Grundstyles -->
    <?php include (TEMPLATEPATH . "/style.php"); ?>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <?php wp_head(); ?>

</head>
<?php echo is_home() ? '<body id="start">' : '<body>'; ?>
<div id="seite">
<a name="seitenmarke" id="seitenmarke"></a>

<!-- KOPF ******************************************************************** -->
<!-- ************************************************************************** -->
<div id="kopf">
    <div id="logo">
        <p><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
        <?php if( get_bloginfo( 'description', 'display' ) ) : ?>
            <span style="display: block; font-size: 0.9em;"><?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?></span>
        <?php endif; ?>
        </p>
    </div>
    <div id="titel">
        <?php
        if (!is_single()):
            if (is_category()): echo '<h1>';
                wp_title('', true);
                echo '</h1>';
            elseif (is_page()): echo '<h1>';
                the_title();
                echo '</h1>';
            else: echo '<h1>';
                bloginfo('name');
                echo '</h1>';
            endif;
        else: echo '<h1>';
            wp_title('', true);
            echo '</h1>';
        endif;
        ?>
    </div>
    <div id="suche">
        <h2><a name="suche">Suche</a></h2>
        <form method="get" action="<?php bloginfo('url') ?>/">
            <p>
                <label for="suchbegriff">Suche:</label>
                <input id="suchbegriff" name="s" type="text" placeholder="<?php _e( 'Suchbegriff eingeben', '_rrze' ); ?>" value="<?php echo get_search_query(); ?>" maxlength="100" />
                <input type="submit" value="suchen" />
            </p>
        </form>
    </div>
    <div id="breadcrumb">
        <?php echo RRZE_Functions::breadcrumb_nav(); ?>
    </div>
    <div id="sprungmarken">
        <h2>Sprungmarken</h2>
        <ul>
            <li class="first"><a href="#contentmarke">Hauptinhalt</a><span class="skip">. </span></li>
            <li><a href="#zusatzinfomarke">Zusatzinformation</a><span class="skip">. </span></li>
            <li><a href="#bereichsmenumarke">Bereichsmenu</a><span class="skip">. </span></li>
            <li class="last"><a href="#hilfemarke">Technisches Menu</a><span class="skip">. </span></li>
        </ul>
    </div>
    <div id="hauptmenu">
        <h2 class="skip"><a name="hauptmenumarke" id="hauptmenumarke">Zielgruppennavigation</a></h2>
        <?php dynamic_sidebar( 2 ); ?>
    </div>

</div>
<hr id="nachkopf" />
