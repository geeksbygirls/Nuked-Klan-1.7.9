<?php
// -------------------------------------------------------------------------//
// Nuked-KlaN - PHP Portal                                                  //
// http://www.nuked-klan.org                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
defined('INDEX_CHECK') or die ('You can\'t run this file alone.');

global $user, $nuked, $language;


// Colonnes � masquer si les tableaux d�bordent en r�solution faible
// - D�finir colonnes dans l'ordre des priorit�s et suivant les pages.
// - Ne g�re pas le colspan/rowspan 
// ---------------------------------------------------------------------
$colonnes_a_masquer = array (
	'Admin,action' => 0,					    //  Avec une valeur � 0, emp�che seulement les longs mots de d�former des cellules
	'Admin,menu' => '4, 3, 2',	 			    // 'file,page' => 'colonne 4, colonne 3, colonne 2'
	'Admin,menu;edit_menu' => '6, 5, 7, 4, 1',  // 'file,page;op' => 'colonne 6, colonne 5, colonne 7, colonne 4, colonne 1'
	'Admin,user' => '4, 3, 2', 			
	'Admin,user;main_ip' => '3, 2',
	'Admin,user;main_cat' => '2, 3',
	'Admin,user;main_valid' => '3, 2',
	'Admin,user;main_rank' => '2',
	'Admin,block' => '4, 5, 3, 2',
	'Admin,modules' => '4, 3, 2',
	'Admin,smilies' => '2, 3',
	'Admin,phpinfo' => 0,
	'Admin,erreursql' => 0,
	'Admin,menu;edit_line' => '8, 7, 6, 5',
	'Sections,admin' => '2, 4, 3',
	'Sections,admin;main_cat' => '2, 3',
	'Calendar,admin' => '3',
	'Comment,admin' => '3',
	'Contact,admin' => '4, 3',
	'Defy,admin' => '3, 4, 2',
	'Forum,admin' => '4, 3, 2',
	'Forum,admin;main_cat' => '2',
	'Forum,admin;main_rank' => '2, 3',
	'Gallery,admin' => '2, 3',
	'Gallery,admin;main_cat' => '2, 3',
	'Irc,admin' => 0,
	'Links,admin' => '2, 3',
	'Links,admin;main_cat' => '2, 3',
	'Links,admin;main_broken' => '3, 4',
	'Guestbook,admin' => '3',
	'Wars,admin' => '4, 2',
	'News,admin' => '4, 2, 3',
	'Recruit,admin' => '3, 4, 2',
	'Server,admin' => '3, 2',
	'Survey,admin' => '3, 2',
	'Suggest,admin' => '4',
	'Textbox,admin' => '3',
	'Download,admin' => '4, 3',
	'Download,admin;main_cat' => '2, 3',
	'Download,admin;main_broken' => '3, 4',
); 

function admintop(){
    
    global $user, $nuked, $language;
    translate("modules/Admin/lang/$language.lang.php");

    $visiteur = $user ? $user[1] : 0;
    $condition_js = ($nuked['screen']) == 'off' ? 1 : 0;
    if($visiteur < 2) redirect('index.php?file=404', 0);
    
    // Tableau associ� au condition sur la class du menu de navigation
    $a = array('setting','maj','phpinfo','mysql','action','erreursql');
    $b = array('user','theme','modules','block','menu','smilies','games');
    
    // Condition sur la class du menu de navigation
    $Current = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'index') ? ' current' : '';
    $MenuParameters = ($_REQUEST['file'] == 'Admin' and in_array($_REQUEST['page'], $a)) ? ' current' : '';
    $SubMenuParameters = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'setting') ? 'class="current"' : '';
    $SubMenuParameters2 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'mysql') ? 'class="current"' : '';
    $SubMenuParameters3 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'phpinfo') ? 'class="current"' : '';
    $SubMenuParameters4 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'action') ? 'class="current"' : '';
    $SubMenuParameters5 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'erreursql') ? 'class="current"' : '';
    $MenuGestion = ($_REQUEST['file'] == 'Admin' and in_array($_REQUEST['page'], $b)) ? ' current' : '';
    $SubMenuGestion = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'user') ? 'class="current"' : '';
    $SubMenuGestion2 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'theme') ? 'class="current"' : '';
    $SubMenuGestion3 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'modules') ? 'class="current"' : '';
    $SubMenuGestion4 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'block') ? 'class="current"' : '';
    $SubMenuGestion5 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'menu') ? 'class="current"' : '';
    $SubMenuGestion6 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'smilies') ? 'class="current"' : '';
    $SubMenuGestion7 = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'games') ? 'class="current"' : '';
    $MenuDivers = ($_REQUEST['file'] == 'Admin' and ($_REQUEST['page'] == 'propos' or $_REQUEST['page'] == 'licence')) ? ' current' : '';
    $SubMenuDivers = ($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'licence') ? 'class="current"' : '';
    $SubMenuDivers2 = ($_REQUEST['file'] == 'Admin' && $_REQUEST['page'] == 'propos') ? 'class="current"' : '';
    
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta name="keywords" content="<?php echo $nuked['keyword'] ?>" />
        <meta name="Description" content="<?php echo $nuked['description'] ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $nuked['name'] ?> - <?php echo $nuked['slogan'] ?></title>
        
        <link rel="shortcut icon"  href="images/favicon.ico" />
        <link rel="stylesheet" href="modules/Admin/css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="modules/Admin/css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="modules/Admin/css/invalid.css" type="text/css" media="screen" />
        
        <script type="text/javascript" src="modules/Admin/scripts/jquery-1.6.1.min.js"></script>
        <script type="text/javascript" src="modules/Admin/scripts/simpla.jquery.configuration.js"></script>
        <script type="text/javascript" src="modules/Admin/scripts/facebox.js"></script>
        <script type="text/javascript">
            var condition_js = '<?php echo $condition_js; ?>';
            var lang_nuked = '<?php echo $language; ?>';
          </script>
        <script type="text/javascript" src="modules/Admin/scripts/config.js"></script>
        </head>
    <body>
    <!-- DEBUT: Patch iframe administration - Par persogamer -->   
    <div id="screen" onclick="screenoff()">
	<div id="boxframe"> 
            <div id="iframe_close" title="Fermer"></div>
            <div id="iframe" align="right"></div>
	</div>
    </div>
    <!-- FIN: Patch iframe administration - Par persogamer -->   
	<div class="container">
	
		<div id="bgfix"></div>
		
        <div id="sidebar">
            
            <!-- Sidebar with logo and menu -->
            <div id="sidebar-wrapper">
                
                <!-- Logo NK -->
                <a href="http://www.nuked-klan.org" target="_blank" id="lien_logo"><img id="logo" src="modules/Admin/images/logo.png" alt="Simpla Admin logo" /></a>
                
                <!-- Sidebar Profile links -->
                <div id="profile-links">
                    <?php echo _BONJOUR; ?> 
                    <a href="index.php?file=User" title="<?php echo _EDIT; ?>"><?php echo $user[2];?></a>, 
                    <?php echo _VOIR; ?> 
                    <a href="#messages" rel="modal"><?php echo _MESSAGES; ?></a><br /><br />
                    <a onclick="javascript:screenon('index.php', 'non');return false" href="#"><?php echo _VOIRSITE; ?></a> | 
                    <a href="index.php?file=Admin&amp;page=deconnexion"><?php echo _DECONNEXION; ?></a><br />
                    <a href="index.php"><?php echo _RETOURNER; ?></a>
                </div>
                
                <!-- Accordion Menu -->
                <ul id="main-nav">
                    
                    <li><a href="index.php?file=Admin" class="nav-top-item no-submenu<?php echo $Current; ?>"><?php echo _PANNEAU; ?></a></li>
                    
                    <li>
                        <!-- SUB MENU : PARAMETERS -->
                        <a href="#" class="nav-top-item<?php echo $MenuParameters; ?>"><?php echo _PARAMETRE; ?></a>
                        
                        <ul>
                            <li><a <?php echo $SubMenuParameters; ?> href="index.php?file=Admin&amp;page=setting"><?php echo _PREFGEN; ?></a></li>
                            <li><a <?php echo $SubMenuParameters2; ?> href="index.php?file=Admin&amp;page=mysql"><?php echo _GMYSQL; ?></a></li>
                            <li><a <?php echo $SubMenuParameters3; ?> href="index.php?file=Admin&amp;page=phpinfo"><?php echo _ADMINPHPINFO; ?></a></li>
                            <li><a <?php echo $SubMenuParameters4; ?> href="index.php?file=Admin&amp;page=action"><?php echo _ACTIONM; ?></a></li>
                            <li><a <?php echo $SubMenuParameters5; ?> href="index.php?file=Admin&amp;page=erreursql"><?php echo _ERRORBDD; ?></a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <!-- SUB MENU : GESTION -->
                        <a href="#" class="nav-top-item<?php echo $MenuGestion; ?>"><?php echo _GESTIONS; ?></a>
                        
                        <ul>
                            <li><a <?php echo $SubMenuGestion; ?> href="index.php?file=Admin&amp;page=user"><?php echo _UTILISATEURS; ?></a></li>
                            
                            <?php if(file_exists('themes/' . $nuked['theme'] . '/admin.php')) { ?>
                                <li><a <?php echo $SubMenuGestion2; ?> href="index.php?file=Admin&amp;page=theme"><?php echo _THEMIS; ?></a></li>
                            <?php } ?>
                            
                            <li><a <?php echo $SubMenuGestion3; ?> href="index.php?file=Admin&amp;page=modules"><?php echo _INFOMODULES; ?></a></li>
                            <li><a <?php echo $SubMenuGestion4; ?> href="index.php?file=Admin&amp;page=block"><?php echo _BLOCK; ?></a></li>
                            <li><a <?php echo $SubMenuGestion5; ?> href="index.php?file=Admin&amp;page=menu"><?php echo _MENU; ?></a></li>
                            <li><a <?php echo $SubMenuGestion6; ?> href="index.php?file=Admin&amp;page=smilies"><?php echo _SMILEY; ?></a></li>
                            <li><a <?php echo $SubMenuGestion7; ?> href="index.php?file=Admin&amp;page=games"><?php echo _JEUX; ?></a></li>
                        </ul>
                    </li>
                    
                        <!-- SUB MENU : CONTENU -->
                        <?php
                        echo '<li>';
                        $modules = array();
                        $Sql = mysql_query("SELECT `nom` FROM `" . MODULES_TABLE . "` WHERE '".$visiteur."' >= admin AND niveau > -1 AND admin > -1 ORDER BY nom");
                        while ($mod = mysql_fetch_assoc($Sql)) {
                            
                            if ($mod['nom'] == 'Gallery') $modname = _NAMEGALLERY;
                            else if ($mod['nom'] == 'Calendar') $modname = _NAMECALANDAR;
                            else if ($mod['nom'] == 'Defy') $modname = _NAMEDEFY;
                            else if ($mod['nom'] == 'Download') $modname = _NAMEDOWNLOAD;
                            else if ($mod['nom'] == 'Guestbook') $modname = _NAMEGUESTBOOK;
                            else if ($mod['nom'] == 'Irc') $modname = _NAMEIRC;
                            else if ($mod['nom'] == 'Links') $modname = _NAMELINKS;
                            else if ($mod['nom'] == 'Wars') $modname = _NAMEMATCHES;
                            else if ($mod['nom'] == 'News') $modname = _NAMENEWS;
                            else if ($mod['nom'] == 'Recruit') $modname = _NAMERECRUIT;
                            else if ($mod['nom'] == 'Sections') $modname = _NAMESECTIONS;
                            else if ($mod['nom'] == 'Server') $modname = _NAMESERVER;
                            else if ($mod['nom'] == 'Suggest') $modname = _NAMESUGGEST;
                            else if ($mod['nom'] == 'Survey') $modname = _NAMESURVEY;
                            else if ($mod['nom'] == 'Forum') $modname = _NAMEFORUM;
                            else if ($mod['nom'] == 'Textbox') $modname = _NAMESHOUTBOX;
                            else if ($mod['nom'] == 'Comment') $modname = _NAMECOMMENT;
                            else $modname = $mod['nom'];

                            array_push($modules, $modname . '|' . $mod['nom']);
                        } // END while

                        natcasesort($modules);
                        
                        foreach ($modules as $value) {
                            
                            $temp = explode('|', $value);

                            if (is_file('modules/' . $temp[1] . '/admin.php'))
                            {
                                if ($_REQUEST['file'] == $temp[1] and $_REQUEST['page'] == 'admin') $modulecur = true;
                            } // END if
                            
                        } // END foreach
                        
                        $CurrentModule = ($modulecur == true) ? ' current' : '';
                        echo '<a href="#" class="nav-top-item' . $CurrentModule . '">' . _CONTENU . '</a><ul>';
                        
                        foreach ($modules as $value) {
                            
                            $temp = explode('|', $value);

                            if (is_file('modules/' . $temp[1] . '/admin.php')) {
                                
                                if ($_REQUEST['file'] == $temp[1] and $_REQUEST['page'] == 'admin') {
                                    
                                    echo '<li><a class="current" href="index.php?file=' . $temp[1] . '&amp;page=admin">' . $temp[0] . '</a></li>';
                                    $modulecur = true;
                                    
                                } else {
                                    
                                    echo '<li><a href="index.php?file=' . $temp[1] . '&amp;page=admin">' . $temp[0] . '</a></li>';
                                    
                                } // END if/else
                                
                            } // END if
                            
                        } // END foreach
                        
                        echo '</ul></li>';
                        
                        ?>
                    <li>
                        <!-- SUB MENU : DIVERS -->
                        <a href="#" class="nav-top-item<?php echo $MenuDivers; ?>"><?php echo _DIVERS; ?></a>
                        
                        <ul>
                            <li><a href="http://www.nuked-klan.org/index.php?file=Forum" target="_blank"><?php echo _OFFICIEL; ?></a></li>
                            <li><a <?php echo $SubMenuDivers; ?> href="index.php?file=Admin&amp;page=licence"><?php echo _LICENCE; ?></a></li>
                            <li><a <?php echo $SubMenuDivers2; ?> href="index.php?file=Admin&amp;page=propos"><?php echo _PROPOS; ?></a></li>
                        </ul>
                    </li>
                </ul>
                <!-- End Accordion Menu -->
                
                <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                <div id="messages">
                    <h3><?php echo _DISCUADMIN; ?>:</h3>
                    <div id="content_messages">
                        
                        <?php
                        $Str = mysql_query("SELECT D.date, D.texte, U.pseudo FROM " . $nuked['prefix'] . "_discussion D, " . USER_TABLE . " U WHERE D.pseudo = U.id ORDER BY D.date DESC LIMIT 0, 16");
                        while ($row = mysql_fetch_assoc($Str)) {
                            
                            ?>
                            <p><strong><?php echo nkDate($row['date']); ?></strong> <?php echo _BY; ?> <?php echo $row['pseudo']; ?><br /><?php echo $row['texte']; ?></p>
                            <?php 
                        } // END while
                        ?>
                        
                    </div>
                    <form method="post" onsubmit="maFonctionAjax(this.texte.value);return false" action="">
                        <h4><?php echo _NEWMSG; ?>:</h4>
                        <fieldset>
                            <textarea name="texte" cols="79" rows="5"></textarea>
                        </fieldset>
                        <fieldset>
                            <input class="button" type="submit" value="Send" />
                        </fieldset>
                    </form>
                    <div id="affichefichier"></div>
                </div>
                <!-- End #messages -->
                
            </div>
            <!-- End #sidebar-wrapper -->
        
        </div>
        
        <!-- End #sidebar -->
        
        <!-- Main Content Section with everything -->
        <div id="main-content">
            <div id="main-content-container">
                <!-- Show a notification if the user has disabled javascript -->
                <noscript>
                    <div class="notification error png_bg">
                        <div><?php echo _JAVA; ?></div>
                    </div>
                </noscript>
<?php
}

function adminfoot(){
    
    global $language, $nuked;
    
    ?>
                <script type="text/javascript" src="media/ckeditor/ckeditor.js"></script>
                <script type="text/javascript">
                    //<![CDATA[
                    CKEDITOR.replaceAll( 'editor' );
                    CKEDITOR.config.scayt_sLang = "<?php echo ($language == 'french') ? 'fr_FR' : 'en_US'; ?>";
                    <?php
                    if($_REQUEST['file'] == 'Forum' && ($_REQUEST['op'] == 'edit_forum' || $_REQUEST['op'] == 'add_forum')){
                        echo 'CKEDITOR.config.autoParagraph = false;
                        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;';
                    }
                    echo ConfigSmileyCkeditor();
                    echo ($nuked['video_editeur'] == 'on') ? 'CKEDITOR.config.extraPlugins = \'Video\';' : '';
                    ?>
                    //]]>
                </script>
            </div>
        </div>
        
    </div>
	
<!-- Scroll Ancre -->
<?php if (!($_REQUEST['file'] == 'Admin' and $_REQUEST['page'] == 'index' and $_REQUEST['op'] == 'index')){ ?>
	<script type="text/javascript">
	$(window).load(function() {
		$('html,body').animate({scrollTop: $("#main-content").offset().top}, 'slow');
	});
	</script>
<?php }	?>

<!-- Colspan=2 dans accueil administration dl -->
<?php if ($_REQUEST['file'] == 'Download' and $_REQUEST['page'] == 'admin' and $_REQUEST['op'] == 'index'){ ?>
	<script type="text/javascript">
	$(window).load(function() {
		$('.tab-content table tr').each(function(){
		   $(this).find('td[colspan="2"]').attr('colspan', 1).after('<td></td>');
		});
	});
	</script>
<?php }	?>

<?php
global $colonnes_a_masquer;

foreach($colonnes_a_masquer as $key => $col){
	
	$presence_virgule = substr_count($key,',');
	$presence_pointvirgule = substr_count($key,';');
	if($presence_virgule != false and $presence_pointvirgule == false) // page
	{
	    $elements = explode(',', $key);
	   
	   	if ($_REQUEST['file'] == $elements[0] and $_REQUEST['page'] == $elements[1] and $_REQUEST['op'] == 'index'){ ?>
		<script type="text/javascript">var colonnes_a_masquer = [<?php echo $col; ?>];</script>
		<?php }	
		
	}
	elseif($presence_pointvirgule != false and $presence_virgule == false) // op
	{
	    $elements2 = explode(';', $key);
	   
	   	if ($_REQUEST['file'] == $elements2[0] and $_REQUEST['op'] == $elements2[1]){ ?>
		<script type="text/javascript">var colonnes_a_masquer = [<?php echo $col; ?>];</script>
		<?php }	
	}
	elseif($presence_virgule != false and $presence_pointvirgule != false) // page and op
	{
	    $elements2 = explode(',', $key);
		$elements3 = explode(';', $elements2[1]);
	   
	   	if ($_REQUEST['file'] == $elements2[0] and $_REQUEST['page'] == $elements3[0] and $_REQUEST['op'] == $elements3[1]){ ?>
		<script type="text/javascript">var colonnes_a_masquer = [<?php echo $col; ?>];</script>
		<?php }	
	}
	else{	
		if ($_REQUEST['file'] == $key and $_REQUEST['page'] == 'index'){ ?>
		<script type="text/javascript">var colonnes_a_masquer = [<?php echo $col; ?>];</script>
		<?php }
	}

}?>
<script type="text/javascript">
// Conteneur principal
var container = '.tab-content';

$(document).ready(function() {
	// cke editor overflow
	$('textarea.editor').wrap('<div class="editor-resp" />');
	
	// cke editor full si 1 cellule
	$('.editor-resp').each(function(){
	
		var prec = $(this).parent('td').prev();
		var suiv = $(this).parent('td').next();

		if(prec.length == 0 && suiv.length == 0){
			$('.editor-resp').attr('class', 'editor-resp-full');
		}
	});
});

$(window).load(function() {

    if(typeof colonnes_a_masquer != 'undefined'){
	
		var largeur_container = $(container).width();
	
		$(container+' table:not(table table)').each(function(){

			for (var i = 0; i < colonnes_a_masquer.length; i++) {
			
				var largeur_tab = $(this).width();
				var col = colonnes_a_masquer[i]-1;
				
				if(largeur_tab > largeur_container)
				{		
					$(this).find('tr').each(function(){
						$(this).find('td:eq('+col+')').addClass('hide-col');
					});
				}
				
				largeur_tab = $(this).width();
				if((largeur_tab > largeur_container) && i==(colonnes_a_masquer.length-1))
				{
					$(this).addClass('word-wrap');
				}			
			}	
		});	
	}
});

$(window).resize(function() {

    if(typeof colonnes_a_masquer != 'undefined'){
		
		var largeur_container = $(container).width();
		
		$(container+' table:not(table table)').each(function(){
		
			$(this).removeClass('word-wrap');
		
			for (var i = 0; i < colonnes_a_masquer.length; i++) {
			
				var largeur_tab = $(this).width();
				var col = colonnes_a_masquer[i]-1;
				
				// Ca d�passe
				if(largeur_tab > largeur_container)
				{		
					$(this).find('tr').each(function(){
						$(this).find('td:eq('+col+')').addClass('hide-col');
					});
					
				}
				// Sinon il peut peut-�tre rester de la place
				else{
				
					// Afficher toutes les colonnes masqu�es et mesure du tableau
					$(this).find('tr').each(function(){		
						$(this).find('td:eq('+col+')').removeClass('hide-col'); //display:none				
					});
					
					largeur_container = $(container).width();
					largeur_tab = $(this).width();
					
					// Ca depasse
					if(largeur_tab > largeur_container)
					{		
						$(this).find('tr').each(function(){
						$(this).find('td:eq('+col+')').addClass('hide-col'); //display:none
						});
					}
				}
				
				// Ca d�passe et il n'y a plus de colonne � masquer
				largeur_container = $(container).width();
				largeur_tab = $(this).width();
				if((largeur_tab > largeur_container) && i==(colonnes_a_masquer.length-1))
				{
					$(this).addClass('word-wrap');
				}
					
			}
		});
	}
});
</script>

</body>
</html>
    <?php
    exit();
}
?>
