<?php
/**
 * Chihuahua - based on Vector
 *
 * @todo document
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) )
   die( -1 );


/**
 * SkinTemplate class for Chihuahua skin
 * @ingroup Skins
 */
class SkinChihuahua extends SkinTemplate {

   /* Functions */
   var $skinname = 'chihuahua', $stylename = 'chihuahua',
      $template = 'ChihuahuaTemplate', $useHeadElement = true;

   /**
    * Initializes output page and sets up skin-specific parameters
    * @param object $out Output page object to initialize
    */
   public function initPage( OutputPage $out ) {
      global $wgStylePath, $wgJsMimeType, $wgStyleVersion, $wgScriptPath, $wgVectorExtraStyles;
      global $wgCanonicalNamespace;
      
      parent::initPage( $out );

      if( $wgCanonicalNamespace == "Archive" ) $out->setIndexPolicy( "noindex" );

   }

   /* Add specific styles for this skin
    *
    * @param $out OutputPage
    */
   function setupSkinUserCss( OutputPage $out ){
     parent::setupSkinUserCss( $out );
     // Append to the default screen common & print styles...
     $out->addStyle( $this->stylename.'/css.php?mode=normal&amp;css-inc=/', 'screen' );
     $out->addStyle( $this->stylename.'/content.css.php?mode=normal&amp;css-inc=/', 'screen' );
     $out->addStyle( $this->stylename.'/css.php?mode=print&amp;css-inc=/', 'print' );
     $out->includeJQuery();
     // $out->addStyle( 'monobook/rtl.css', 'screen', '', 'rtl' );
   }

    /* Builds a structured array of links used for tabs and menus
    * @return array
    * @private
    */
   function buildNavigationUrls() {
      global $wgContLang, $wgLang, $wgOut, $wgUser, $wgRequest, $wgArticle, $wgStylePath;
      global $wgDisableLangConversion, $wgVectorUseIconWatch;

      wfProfileIn( __METHOD__ );

      $links = array(
         'namespaces' => array(),
         'views' => array(),
         'actions' => array(),
         'variants' => array()
      );

      // Detects parameters
      $action = $wgRequest->getVal( 'action', 'view' );
      $section = $wgRequest->getVal( 'section' );

      // Checks if page is some kind of content
//      if( $this->iscontent ) {
      if($this->getSkin()->getTitle()->getNamespace() != -1) {

         // Gets page objects for the related namespaces
         $subjectPage = $this->getSkin()->getTitle()->getSubjectPage();
         $talkPage = $this->getSkin()->getTitle()->getTalkPage();

         // Determines if this is a talk page
         $isTalk = $this->getSkin()->getTitle()->isTalkPage();

         // Generates XML IDs from namespace names
         $subjectId = $this->getSkin()->getTitle()->getNamespaceKey( '' );

         if ( $subjectId == 'main' ) {
            $talkId = 'talk';
         } else {
            $talkId = "{$subjectId}_talk";
         }
         $currentId = $isTalk ? $talkId : $subjectId;

         // Adds namespace links
         /*$links['namespaces'][$subjectId] = $this->tabAction(
            $subjectPage, 'vector-namespace-' . $subjectId, !$isTalk, '', true
         );
         $links['namespaces'][$subjectId]['img'] = "page.png";
         $links['namespaces'][$subjectId]['context'] = 'subject';*/

//          $links['namespaces']['logo'] = array(
//                'class' => 'logo-small',
//                'text' => "WikiFM - Share your knowledge",
//                'href' => "",
//                'img' => 'logosmall.png',
//             );

         $links['namespaces'][$talkId] = $this->tabAction(
            $talkPage, 'vector-namespace-talk', $isTalk, '', true
         );
         $links['namespaces'][$talkId]['img'] = "discussion.png";
         $links['namespaces'][$talkId]['context'] = 'talk';

         
         // Adds view view link
         /*if ( $this->getSkin()->getTitle()->exists() ) {
            $links['views']['view'] = $this->tabAction(
               $isTalk ? $talkPage : $subjectPage,
                  'vector-view-view', ( $action == 'view' ), '', true
            );
         }*/

         wfProfileIn( __METHOD__ . '-edit' );

         // Checks if user can...
         if (
            //true
	    // edit the current page
            $this->getSkin()->getTitle()->quickUserCan( 'edit' ) &&
            //$this->data['edit']
            (
               // if it exists
               $this->getSkin()->getTitle()->exists() ||
               // or they can create one here
	       $this->getSkin()->getTitle()->quickUserCan( 'create' )
            )
         ) {
            // Builds CSS class for talk page links
            $isTalkClass = $isTalk ? ' istalk' : '';

            // Determines if we're in edit mode
            $selected = (
               ( $action == 'edit' || $action == 'submit' ) &&
               ( $section != 'new' )
            );
            $links['actions']['edit'] = array(
               'class' => ( $selected ? 'selected' : '' ) . $isTalkClass,
               'text' => $this->getSkin()->getTitle()->exists()
                  ? wfMsg( 'vector-view-edit' )
                  : wfMsg( 'vector-view-create' ),
               'href' =>
                  $this->getSkin()->getTitle()->getLocalUrl( $this->editUrlOptions() ),
               'img' => 'edit.overlay.png',
            );
            // Checks if this is a current rev of talk page and we should show a new
            // section link
            if ( ( $isTalk && $wgArticle->isCurrent() ) || ( $wgOut->showNewSectionLink() ) ) {
               // Checks if we should ever show a new section link
               if ( !$wgOut->forceHideNewSectionLink() ) {
                  // Adds new section link
                  //$links['actions']['addsection']
                  $links['actions']['addsection'] = array(
                     'class' => 'collapsible ' . ( $section == 'new' ? 'selected' : false ),
                     'text' => wfMsg( 'vector-action-addsection' ),
                     'href' => $this->getSkin()->getTitle()->getLocalUrl(
                        'action=edit&section=new'
                     ),
                     'img' => 'add.overlay.png', //TODO: replace
                  );
               }
            }
         // Checks if the page is known (some kind of viewable content)
         } elseif ( $this->getSkin()->getTitle()->isKnown() ) {
            // Adds view source view link
            $links['views']['viewsource'] = array(
               'class' => ( $action == 'edit' ) ? 'selected' : false,
               'text' => wfMsg( 'vector-view-viewsource' ),
               'href' =>
                  $this->getSkin()->getTitle()->getLocalUrl( $this->editUrlOptions() ),
               'img' => 'source.png',
            );
         }
         wfProfileOut( __METHOD__ . '-edit' );

         wfProfileIn( __METHOD__ . '-live' );

         // Checks if the page exists
         if ( $this->getSkin()->getTitle()->exists() ) {
	    // Adds history view link
//             $links['views']['history'] = array(
//                'class' => 'collapsible ' . ( ($action == 'history') ? 'selected' : false ),
//                'text' => wfMsg( 'vector-view-history' ),
//                'href' => $this->getSkin()->getTitle()->getLocalUrl( 'action=history' ),
//                'rel' => 'archives',
//                'img' => 'history.png',
//             );
	}

         if ( $this->getSkin()->getTitle()->exists() ) {
            // Adds latex download link
/*            $links['views']['wiki2latex'] = array(
               'class' => 'collapsible ' . ( ($action == 'w2llatexform') ? 'selected' : false ),
               'text' => wfMsg( 'w2l_tab' ),
               'href' => $this->getSkin()->getTitle()->getLocalUrl( 'action=w2llatexform' ),
               'img' => 'get-pdf.png',
            );*/

            if( $wgUser->isAllowed( 'delete' ) ) {
               $links['actions']['delete'] = array(
                  'class' => ($action == 'delete') ? 'selected' : false,
                  'text' => wfMsg( 'vector-action-delete' ),
                  'href' => $this->getSkin()->getTitle()->getLocalUrl( 'action=delete' ),
                  'img' => 'delete.overlay.png',
               );
            }
            if ( $this->getSkin()->getTitle()->quickUserCan( 'move' ) ) {
               $moveTitle = SpecialPage::getTitleFor(
                  'Movepage', $this->thispage
               );
               $links['actions']['move'] = array(
                  'class' => $this->getSkin()->getTitle()->isSpecial( 'Movepage' ) ?
                              'selected' : false,
                  'text' => wfMsg( 'vector-action-move' ),
                  'href' => $moveTitle->getLocalUrl(),
                  'img' => 'move.overlay.png',
               );
            }

            if (
               $this->getSkin()->getTitle()->getNamespace() !== NS_MEDIAWIKI &&
               $wgUser->isAllowed( 'protect' )
            ) {
               if ( !$this->getSkin()->getTitle()->isProtected() ){
                  $links['actions']['protect'] = array(
                     'class' => ($action == 'protect') ?
                                 'selected' : false,
                     'text' => wfMsg( 'vector-action-protect' ),
                     'href' =>
                        $this->getSkin()->getTitle()->getLocalUrl( 'action=protect' ),
                     'img' => 'lock.overlay.png',
                  );

               } else {
                  $links['actions']['unprotect'] = array(
                     'class' => ($action == 'unprotect') ?
                                 'selected' : false,
                     'text' => wfMsg( 'vector-action-unprotect' ),
                     'href' =>
                        $this->getSkin()->getTitle()->getLocalUrl( 'action=unprotect' ),
                     'img' => 'lock.overlay.png',
                  );
               }
            }
         } else {
            // article doesn't exist or is deleted
            if (
               $wgUser->isAllowed( 'deletedhistory' ) &&
               $wgUser->isAllowed( 'undelete' )
            ) {
               if( $n = $this->getSkin()->getTitle()->isDeleted() ) {
                  $undelTitle = SpecialPage::getTitleFor( 'Undelete' );
                  $links['actions']['undelete'] = array(
                     'class' => false,
                     'text' => wfMsgExt(
                        'vector-action-undelete',
                        array( 'parsemag' ),
                        $wgLang->formatNum( $n )
                     ),
                     'href' => $undelTitle->getLocalUrl(
                        'target=' . urlencode( $this->thispage )
                     ),
                     'img' => 'delete.overlay.png',
                  );
               }
            }

            if (
               $this->getSkin()->getTitle()->getNamespace() !== NS_MEDIAWIKI &&
               $wgUser->isAllowed( 'protect' )
            ) {
               if ( !$this->getSkin()->getTitle()->getRestrictions( 'create' ) ) {
                  $links['actions']['protect'] = array(
                     'class' => ($action == 'protect') ?
                                 'selected' : false,
                     'text' => wfMsg( 'vector-action-protect' ),
                     'href' =>
                        $this->getSkin()->getTitle()->getLocalUrl( 'action=protect' ),
                     'img' => 'lock.overlay.png',
                  );

               } else {
                  $links['actions']['unprotect'] = array(
                     'class' => ($action == 'unprotect') ?
                                 'selected' : false,
                     'text' => wfMsg( 'vector-action-unprotect' ),
                     'href' =>
                        $this->getSkin()->getTitle()->getLocalUrl( 'action=unprotect' ),
                     'img' => 'lock.overlay.png',
                  );
               }
            }
         }
         wfProfileOut( __METHOD__ . '-live' );
         /**
          * The following actions use messages which, if made particular to
          * the Vector skin, would break the Ajax code which makes this
          * action happen entirely inline. Skin::makeGlobalVariablesScript
          * defines a set of messages in a javascript object - and these
          * messages are assumed to be global for all skins. Without making
          * a change to that procedure these messages will have to remain as
          * the global versions.
          */
         // Checks if the user is logged in
         if ( $this->loggedin ) {
//	 if (true) {
            if ( $wgVectorUseIconWatch ) {
               $class = 'icon ';
               $place = 'views';
            } else {
               $class = '';
               $place = 'actions';
            }
            $mode = $this->getSkin()->getTitle()->userIsWatching() ? 'unwatch' : 'watch';
            $links[$place][$mode] = array(
               'class' => $class . ( ( $action == 'watch' || $action == 'unwatch' ) ? ' selected' : false ),
               'text' => wfMsg( $mode ), // uses 'watch' or 'unwatch' message
               'href' => $this->getSkin()->getTitle()->getLocalUrl( 'action=' . $mode ),
               'img' => 'watch.overlay.png',
            );
         }
         // This is instead of SkinTemplateTabs - which uses a flat array
         wfRunHooks( 'SkinTemplateNavigation', array( &$this, &$links ) );

      // If it's not content, it's got to be a special page
      } else {
         $links['namespaces']['special'] = array(
            'class' => 'selected',
            'text' => wfMsg( 'vector-namespace-special' ),
            'href' => $wgRequest->getRequestURL(),
            'img' => 'special.png',
         );
      }

      // Gets list of language variants
      $variants = $wgContLang->getVariants();
      // Checks that language conversion is enabled and variants exist
      if( !$wgDisableLangConversion && count( $variants ) > 1 ) {
         // Gets preferred variant
         $preferred = $wgContLang->getPreferredVariant();
         // Loops over each variant
         foreach( $variants as $code ) {
            // Gets variant name from language code
            $varname = $wgContLang->getVariantname( $code );
            // Checks if the variant is marked as disabled
            if( $varname == 'disable' ) {
               // Skips this variant
               continue;
            }
            // Appends variant link
            $links['variants'][] = array(
               'class' => ( $code == $preferred ) ? 'selected' : false,
               'text' => $varname,
               'href' => $this->getSkin()->getTitle()->getLocalURL( '', $code ),
               'img' => 'page.gif',
            );
         }
      }

      wfProfileOut( __METHOD__ );
      
    return $links;
   }
   
   function subPageSubtitle() {

      global $wgOut;

      $subpages = '';
      if( !wfRunHooks( 'SkinSubPageSubtitle', array( &$subpages ) ) ) {
         return $subpages;
      }
      if( $wgOut->isArticle() && MWNamespace::hasSubpages( $this->getSkin()->getTitle()->getNamespace() ) ) {
         $ptext = $this->getSkin()->getTitle()->getPrefixedText();
         $links = explode( '/', $ptext );
         $pagename = array_pop( $links );
         if( preg_match( '/\//', $ptext ) ) {
            $c = 0;
            $growinglink = '';
            $display = '';
            foreach( $links as $link ) {
               $growinglink .= $link;
               $display .= $link;
               $linkObj = Title::newFromText( $growinglink );
               if( is_object( $linkObj ) && $linkObj->exists() ) {
                  $getlink = $this->link(
                     $linkObj,
                     htmlspecialchars( $display ),
                     array(),
                     array(),
                     array( 'known', 'noclasses' )
                  );
                  $c++;
                  if( $c > 1 ) {
                     $subpages .= ' &lsaquo; ';
                  } 
                  $subpages .= $getlink;
                  $display = '';
               } else {
                  $display .= '/';
               }
               $growinglink .= '/';
            }
            $subpages .= " &lsaquo; ";
         }
         $subpages .= $pagename;
      }

      return $subpages;
   }

}

/**
 * QuickTemplate class for Vector skin
 * @ingroup Skins
 */
class ChihuahuaTemplate extends QuickTemplate {

   /* Members */

   /**
    * @var Cached skin object
    */
   var $skin;

   /* Functions */

   /**
    * Outputs the entire contents of the XHTML page
    */
   public function execute() {
      global $wgRequest, $wgOut, $wgCanonicalNamespace, $wgContLang, $wgSitename, $wgLogo, $wgStylePath;

      $this->skin = $this->data['skin'];
      $action = $wgRequest->getText( 'action' );

      // Build additional attributes for navigation urls
      $nav = $this->skin->buildNavigationUrls();
      foreach ( $nav as $section => $links ) {
         foreach ( $links as $key => $link ) {
            $xmlID = $key;
            if ( isset( $link['context'] ) && $link['context'] == 'subject' ) {
               $xmlID = 'ca-nstab-' . $xmlID;
            } else if ( isset( $link['context'] ) && $link['context'] == 'talk' ) {
               $xmlID = 'ca-talk';
            } else {
               $xmlID = 'ca-' . $xmlID;
            }
            if (!isset( $nav[$section][$key]['attributes'] )) {
                $nav[$section][$key]['attributes'] = "";
            } else { 
                $nav[$section][$key]['attributes'] = ' id="' . Sanitizer::escapeId( $xmlID ) . '"';
            }
             if ( $nav[$section][$key]['class'] ) {
#		error_log( "!$section!$key!" . serialize( $nav[$section] ) );
               if (!isset( $nav[$section][$key]['attributes'] )) {
                    $nav[$section][$key]['attributes'] = ' class="' . htmlspecialchars( $link['class'] ) . '"';
               } else {
                   $nav[$section][$key]['attributes'] .= ' class="' . htmlspecialchars( $link['class'] ) . '"';
               }
               unset( $nav[$section][$key]['class'] );
             }
            // We don't want to give the watch tab an accesskey if the page
            // is being edited, because that conflicts with the accesskey on
            // the watch checkbox.  We also don't want to give the edit tab
            // an accesskey, because that's fairly superfluous and conflicts
            // with an accesskey (Ctrl-E) often used for editing in Safari.
             if (
               in_array( $action, array( 'edit', 'submit' ) ) &&
               in_array( $key, array( 'edit', 'watch', 'unwatch' ) )
            ) {
                $nav[$section][$key]['key'] =
                  $this->skin->tooltip( $xmlID );
             } else {
                $nav[$section][$key]['key'] =
                  $this->skin->tooltip( $xmlID );
             }
         }
      }
      $this->data['namespace_urls'] = $nav['namespaces'];
      $this->data['view_urls'] = $nav['views'];
      $this->data['action_urls'] = $nav['actions'];
      $this->data['variant_urls'] = $nav['variants'];
      // Build additional attributes for personal_urls
      foreach ( $this->data['personal_urls'] as $key => $item) {
         $this->data['personal_urls'][$key]['attributes'] =
            ' id="' . Sanitizer::escapeId( "pt-$key" ) . '"';
         if ( isset( $item['active'] ) && $item['active'] ) {
            $this->data['personal_urls'][$key]['attributes'] .=
               ' class="active"';
         }
         $this->data['personal_urls'][$key]['key'] =
            $this->skin->tooltip('pt-'.$key);
      }

      // Generate additional footer links
//      $this->data['trademark'] = 'KDE<sup>&#174;</sup> and the K Desktop Environment<sup>&#174;</sup> logo are registered trademarks of <a href="http://ev.kde.org/" title="Homepage of the KDE non-profit Organization">KDE e.V.</a>';
//      $this->data['legal'] = '<a href="http://www.kde.org/contact/impressum.php">Legal</a>';
    $this->data['trademark'] = 'Design based on the Chihuahua theme from KDE';

      $footerlinks = array(
         'info' => array(
            'lastmod',
            'viewcount',
            'numberofwatchingusers',
            'credits',
            'tagline'
         ),
         'licences' => array(
            'copyright'
         ),
         'places' => array(
            'privacy',
            'about',
            'disclaimer'
         ),
         'legals' => array(
            'trademark',
            'legal'
         )
      );
      // Reduce footer links down to only those which are being used
      $validFooterLinks = array();
      foreach( $footerlinks as $category => $links ) {
         $validFooterLinks[$category] = array();
         foreach( $links as $link ) {
            if( isset( $this->data[$link] ) && $this->data[$link] ) {
               $validFooterLinks[$category][] = $link;
            }
         }
      }
      // Reverse horizontally rendered navigation elements
      if ( $wgContLang->isRTL() ) {
         $this->data['view_urls'] =
            array_reverse( $this->data['view_urls'] );
         $this->data['namespace_urls'] =
            array_reverse( $this->data['namespace_urls'] );
         $this->data['personal_urls'] =
            array_reverse( $this->data['personal_urls'] );
      }
      // Output HTML Page
      $this->html( 'headelement' );
?>
<!-- content -->

<div class="root">
   <div id="header">
      <div class="noprint"><?php $this->renderNavigation( array( 'SEARCH' ) ); ?></div>
      <img style="height: 22px; width: 22px; margin-top: 2px;" src="<?php echo $wgStylePath; ?>/chihuahua/images/breadcrumb.png" />
      <!-- subtitle = kind of breadcrumbs -->
      <div id="contentSub"<?php $this->html('userlangattributes') ?>>&nbsp;&nbsp;<?php /*if ($this->data['subtitle'] != ""): */?><a href="<?php echo $this->skin->makeMainPageUrl(); ?>"><?php echo $wgSitename; /*endif;*/ ?></a>&nbsp;&nbsp;</div>
      <!-- /subtitle -->

   </div> <!-- header -->
    
   <div id="sidebar" class="<?php if (isset($_COOKIE['kde_userbase_sidebar_position']) && $_COOKIE['kde_userbase_sidebar_position'] == 'left') echo "left"; ?> noprint">
      <div class="box-t-wrap1">
         <div class="box-t-wrap2">
            <div class="box-t-wrap3">
               <div class="sidebar-header">
                  <img src="<?php echo $wgStylePath; ?>/chihuahua/images/borderlogo.png" alt="Share your knowledge" style="/*margin-top:-12px;*/" onclick="swapSidebar()" onmouseover="this.style.cursor='pointer'" />
               </div>
            </div> <!-- wrap3 -->
         </div> <!-- wrap2 -->
      </div> <!-- wrap1 -->
      <div class="box-m-wrap1">
         <div class="box-m-wrap2">
            <div class="box-m-wrap3">
               <div class="sidebar-content">
                  <!-- panel -->
                  <div id="mw-panel">
                  <!-- logo -->
                     <div id="p-logo"><a style="background-image: url(<?php $this->text( 'logopath' ) ?>); height: 32px; width: 32px;" href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>" <?php echo $this->skin->tooltip( 'p-logo' ) ?>></a></div>
                     <!-- /logo -->
                     
                     <?php $this->renderPortals( $this->data['sidebar'] ); ?>
                 </div><!-- /panel -->
                  <div id="personal">
                     <?php $this->renderNavigation( 'PERSONAL' ); ?>
                  </div> <!-- /personal -->
                  <!-- fixalpha -->
                  <script type="<?php $this->text('jsmimetype') ?>"> if ( window.isMSIE55 ) fixalpha(); </script>
               </div> <!-- /sidebar-content -->
            </div> <!-- /wrap3 -->
         </div> <!-- /wrap2 -->
      </div>  <!-- /wrap1 -->
      <div class="box-b-wrap1">
         <div class="box-b-wrap2">
            <div class="box-b-wrap3">
               <div class="sidebar-footer">
                  <ul id="footer-icons" class="noprint">

<!-- Open Hatch -->
<li>
<form method="POST" action="http://openhatch.org/+do/project.views.wanna_help_do">
    <input type="submit" style="width: 173px;" value="Voglio aiutare!" rel="tipsy-south" id="openhatch-wannahelp-button" original-title="Fai click qui per contribuire alla realizzazione di WikiFM. Aiuti di ogni forma sono graditi : )" /> 
</form>
<style>
    @import url('//openhatch.org/static/css/tipsy.css');
</style>
<style type="text/css">
#openhatch-wannahelp-button:hover, #openhatch-wannahelp-button:focus { background-image:url('//openhatch.org/static/images/wannahelp-button-bg-hover.png'); color:#222; text-decoration:none; }
#openhatch-wannahelp-button { background: #C8E29D url('//openhatch.org/static/images/wannahelp-button-bg.png') repeat-x scroll center top; border:3px solid #fff;  cursor:pointer; cursor: hand; font-family: Helvetica, sans-serif; font-size:13pt; font-weight:normal; text-align:center; text-shadow:0 1px 0 #fff; white-space:normal; }
#openhatch-wannahelp-button { -moz-border-radius: 8px; color: #444; float:left; padding:10px 20px; display:block; padding:2px 8px; }
#openhatch-wannahelp-button:focus { outline-color:-moz-use-text-color; outline-style:none; outline-width:medium; }
</style>
</li>
<!-- Open Hatch END -->
                     <?php if ( $this->data['copyrightico'] ): ?>
<!--                         <li id="footer-icon-copyrightico"><?php $this->html( 'copyrightico' ) ?></li> -->
                     <?php endif; ?>
                     <?php if ( $this->data['poweredbyico'] ): ?>
<!--                         <li id="footer-icon-poweredby"><?php $this->html( 'poweredbyico' ) ?></li> -->
<!--                         <li style="font-size: 80%; padding-bottom: 5px;"> Design based on the Chihuahua theme from KDE</li> -->
                     <?php endif; ?>
                  </ul>
               </div> <!-- sidebar-footer -->
            </div> <!-- wrap3 -->
         </div> <!-- wrap2 -->
      </div> <!-- wrap1 -->
   </div> <!--sidebar -->
   
   <div id="content" <?php $this->html('specialpageattributes') ?>>

      <!-- header -->
      <div class="box-t-wrap1">
         <div class="box-t-wrap2">
            <div class="box-t-wrap3">
               <div id="mw-head" class="noprint">
                  <div id="right-navigation">
                     <?php $this->renderNavigation( array( 'VIEWS' ) ); ?>
                  </div> <!-- right-navigation -->
                  <div id="action-navigation">
                     <?php $this->renderNavigation( array( 'ACTIONS' ) ); ?>
                  </div>
                  <div id="left-navigation">
                     <?php $this->renderNavigation( array( 'NAMESPACES', 'VARIANTS' ) ); ?>
                      <?php $this->html( 'subtitle' ); ?>
                  </div> <!-- /left-navigation -->
                  <div style="clear:left"></div>
               </div><!-- /mw-head -->
            </div> <!-- /wrap3 -->
         </div> <!-- /wrap2 -->
      </div> <!-- /wrap1 -->
      
      <!-- bodyContent -->
      <div id="body">
         <div class="box-m-wrap1">
            <div class="box-m-wrap2">
               <div class="box-m-wrap3">
                  <div id="right">
                     <div class="content">
                        <div id="main">
                           <a id="top"></a>
                           <div id="mw-js-message" style="display:none;"<?php $this->html('userlangattributes') ?>></div>
                           <?php if ( $this->data['sitenotice'] ): ?>
                           <!-- sitenotice -->
                           <div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
                           <!-- /sitenotice -->
                           <?php endif; ?>
                           <!-- firstHeading -->
                           <h1 id="firstHeading" class="firstHeading"><?php $this->html( 'title' ) ?></h1>
                           <!-- /firstHeading -->
                           <!-- tagline 
                           <h3 id="siteSub"><?php $this->msg( 'tagline' ) ?></h3>
                           /tagline -->
                           <?php if ( $this->data['undelete'] ): ?>
                           <!-- undelete -->
                           <div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
                           <!-- /undelete -->
                           <?php endif; ?>
                           <?php if($this->data['newtalk'] ): ?>
                           <!-- newtalk -->
                           <div class="usermessage"><?php $this->html( 'newtalk' )  ?></div>
                           <!-- /newtalk -->
                           <?php endif; ?>

                           <!-- bodytext -->
                           <?php $this->html( 'bodytext' ) ?>
                           <!-- /bodytext -->

                           <?php if ( $this->data['catlinks'] ): ?>
                           <!-- catlinks -->
                              <?php $this->html( 'catlinks' ); ?>
                           <!-- /catlinks -->
                           <?php endif; ?>
                           <?php if ( $this->data['dataAfterContent'] ): ?>
                           <!-- dataAfterContent -->
                           <?php $this->html( 'dataAfterContent' ); ?>
                           <!-- /dataAfterContent -->
                           <?php endif; ?>
                           <div class="visualClear"></div>
                        </div>
                     <!-- /bodyContent -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="box-b-wrap1">
            <div class="box-b-wrap2">
               <div class="box-b-wrap3">
               <div id="footer"<?php $this->html('userlangattributes') ?>>
                  <?php foreach( $validFooterLinks as $category => $links ): ?>
                  <?php if ( count( $links ) > 0 ): ?>
                  <ul id="footer-<?php echo $category ?>">
                     <?php foreach( $links as $link ): ?>
                     <li id="footer-<?php echo $category ?>-<?php echo $link ?>"><?php $this->html( $link ) ?></li>
                     <?php endforeach; ?>
                   </ul>
                   <?php endif; ?>
                  <?php endforeach; ?>
               </div><!-- /footer -->
               </div> <!-- wrap3 -->
            </div> <!-- wrap2 -->
         </div> <!-- wrap1 -->
      </div><!-- /content -->
   </div>
   <!-- footer -->
</div> <!-- Root -->
<!-- /fixalpha -->
<?php $this->html( 'bottomscripts' ); /* JS call to runBodyOnloadHook */ ?>
<script type="<?php $this->text('jsmimetype') ?>">
        // Fix trailing '/' issue
        var loc = window.location.pathname.toString();

        if (loc.substr(loc.length - 1, 1) == '/' && loc != '/') {
                window.location = loc.substr(0, loc.length - 1);
        }
</script>

<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/chihuahua/jquery.mailme.js"></script>
<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/chihuahua/main.js"></script>
<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/chihuahua/jquery.makeCollapsible.js"></script>
<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/chihuahua/jquery.tipsy.js"></script>

<script type="<?php $this->text('jsmimetype') ?>">

$(document).ready(function() {
        $('span.mailme').mailme();

        $("[rel='tipsy-north']").tipsy({'gravity': 'n'});
        $("[rel='tipsy-east']").tipsy({'gravity': 'e'});
        $("[rel='tipsy-west']").tipsy({'gravity': 'w'});
        $("[rel='tipsy-south']").tipsy({'gravity': 's'});

        $("#ca-nstab-main img").click(function(event){$(this).toggleClass("down");});
        $("#ca-talk img").click(function(event){$(this).toggleClass("down");});
        $("#ca-special img").click(function(event){$(this).toggleClass("down");});
        $("#ca-history img").click(function(event){$(this).toggleClass("down");});
        $("#ca-latex img").click(function(event){$(this).toggleClass("down");});
        $("#ca-viewsource img").click(function(event){$(this).toggleClass("down");});
  
        // Set sidebar location
        setSidebar();
  
        // This is the maximum number of TOC entries allowed
        maxEntries = 25;
  
        // Let's hide the TOC
        hideLongToc();
});
 
$(window).resize(function() {
        fixLayout();
});
</script>
<?php $this->html( 'reporttime' ) ?>
<?php if ( $this->data['debug'] ): ?>
<!-- <?php $this->text( 'debug' ); ?> -->
<?php endif; ?>
</body>
</html>
<?php
   }

   /**
    * Render a series of portals
    */
   private function renderPortals( $portals ) {
      // Force the rendering of the following portals
      if ( !isset( $portals['SEARCH'] ) ) $portals['SEARCH'] = true;
      if ( !isset( $portals['TOOLBOX'] ) ) $portals['TOOLBOX'] = true;
      if ( !isset( $portals['LANGUAGES'] ) ) $portals['LANGUAGES'] = true;
      // Render portals
      foreach ( $portals as $name => $content ) {
         echo "\n<!-- {$name} -->\n";
         switch( $name ) {
            case 'SEARCH':
               break;
            case 'TOOLBOX':
?>
<div class="portal" id="p-tb">
   <h5<?php $this->html('userlangattributes') ?>><?php $this->msg( 'toolbox' ) ?></h5>
   <div class="body">
      <ul>
      <?php if( $this->data['notspecialpage'] ): ?>
         <li id="t-whatlinkshere"><a href="<?php echo htmlspecialchars( $this->data['nav_urls']['whatlinkshere']['href'] ) ?>"<?php echo ""; //$this->skin->tooltip( 't-whatlinkshere' ) ?>><?php $this->msg( 'whatlinkshere' ) ?></a></li>
         <?php if( $this->data['nav_urls']['recentchangeslinked'] ): ?>
         <li id="t-recentchangeslinked"><a href="<?php echo htmlspecialchars( $this->data['nav_urls']['recentchangeslinked']['href'] ) ?>"<?php echo ""; //$this->skin->tooltip( 't-recentchangeslinked' ) ?>><?php $this->msg( 'recentchangeslinked-toolbox' ) ?></a></li>
         <?php endif; ?>
      <?php endif; ?>
      <?php if( isset( $this->data['nav_urls']['trackbacklink'] ) ): ?>
      <li id="t-trackbacklink"><a href="<?php echo htmlspecialchars( $this->data['nav_urls']['trackbacklink']['href'] ) ?>"<?php echo ""; //$this->skin->tooltip( 't-trackbacklink' ) ?>><?php $this->msg( 'trackbacklink' ) ?></a></li>
      <?php endif; ?>
      <?php if( $this->data['feeds']): ?>
      <li id="feedlinks">
         <?php foreach( $this->data['feeds'] as $key => $feed ): ?>
         <a id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>" href="<?php echo htmlspecialchars( $feed['href'] ) ?>" rel="alternate" type="application/<?php echo $key ?>+xml" class="feedlink"<?php echo $this->skin->tooltip( 'feed-' . $key ) ?>><?php echo htmlspecialchars( $feed['text'] ) ?></a>
         <?php endforeach; ?>
      </li>
      <?php endif; ?>
      <?php foreach( array( 'contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages' ) as $special ): ?>
         <?php if( $this->data['nav_urls'][$special]): ?>
         <li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars( $this->data['nav_urls'][$special]['href'] ) ?>"<?php echo $this->skin->tooltip( 't-' . $special ) ?>><?php $this->msg( $special ) ?></a></li>
         <?php endif; ?>
      <?php endforeach; ?>
      <?php if( !empty( $this->data['nav_urls']['print']['href'] ) ): ?>
      <li id="t-print"><a href="<?php echo htmlspecialchars( $this->data['nav_urls']['print']['href'] ) ?>" rel="alternate"<?php echo $this->skin->tooltip( 't-print' ) ?>><?php $this->msg( 'printableversion' ) ?></a></li>
      <?php endif; ?>
      <?php if (  !empty(  $this->data['nav_urls']['permalink']['href'] ) ): ?>
      <li id="t-permalink"><a href="<?php echo htmlspecialchars( $this->data['nav_urls']['permalink']['href'] ) ?>"<?php echo $this->skin->tooltip( 't-permalink' ) ?>><?php $this->msg( 'permalink' ) ?></a></li>
      <?php elseif ( $this->data['nav_urls']['permalink']['href'] === '' ): ?>
      <li id="t-ispermalink"<?php echo $this->skin->tooltip( 't-ispermalink' ) ?>><?php $this->msg( 'permalink' ) ?></li>
      <?php endif; ?>
      <?php wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) ); ?>
      </ul>
   </div>
</div>
<?php
               break;
            case 'LANGUAGES':
               if ( $this->data['language_urls'] ) {
?>
<div class="portal" id="p-lang">
   <h5<?php $this->html('userlangattributes') ?>><?php $this->msg( 'otherlanguages' ) ?></h5>
   <div class="body">
      <ul>
      <?php foreach ( $this->data['language_urls'] as $langlink ): ?>
         <li class="<?php echo htmlspecialchars(  $langlink['class'] ) ?>"><a href="<?php echo htmlspecialchars( $langlink['href'] ) ?>"><?php echo $langlink['text'] ?></a></li>
      <?php endforeach; ?>
      </ul>
   </div>
</div>
<?php
               }
               break;
            default:
?>
<div class="portal" id='<?php echo Sanitizer::escapeId( "p-$name" ) ?>'<?php echo $this->skin->tooltip( 'p-' . $name ) ?>>
   <h5<?php $this->html('userlangattributes') ?>><?php $out = wfMsg( $name ); if ( wfEmptyMsg( $name, $out ) ) echo htmlspecialchars( $name ); else echo htmlspecialchars( $out ); ?></h5>
   <div class="body">
      <?php if ( is_array( $content ) ): ?>
      <ul>
      <?php foreach( $content as $key => $val ): ?>
         <li id="<?php echo Sanitizer::escapeId( $val['id'] ) ?>"<?php if ( $val['active'] ): ?> class="active" <?php endif; ?>><a href="<?php echo htmlspecialchars( $val['href'] ) ?>"<?php echo ""; //$this->skin->tooltip( $val['id'] ) ?>><?php echo htmlspecialchars( $val['text'] ) ?></a></li>
      <?php endforeach; ?>
      </ul>
      <?php else: ?>
      <?php echo $content; /* Allow raw HTML block to be defined by extensions */ ?>
      <?php endif; ?>
   </div>
</div>
<?php
            break;
         }
         echo "\n<!-- /{$name} -->\n";
      }
   }

   /**
    * Render one or more navigations elements by name, automatically reveresed
    * when UI is in RTL mode
    */
   private function renderNavigation( $elements ) {
      global $wgContLang, $wgVectorUseSimpleSearch, $wgStylePath;

      // If only one element was given, wrap it in an array, allowing more
      // flexible arguments
      if ( !is_array( $elements ) ) {
         $elements = array( $elements );
      // If there's a series of elements, reverse them when in RTL mode
      } else if ( $wgContLang->isRTL() ) {
         $elements = array_reverse( $elements );
      }
      // Render elements
      foreach ( $elements as $name => $element ) {
         echo "\n<!-- {$name} -->\n";
         switch ( $element ) {
            case 'NAMESPACES':
?>
<div id="p-namespaces" class="vectorTabs<?php if ( count( $this->data['namespace_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
   <h5><?php $this->msg('namespaces') ?></h5>
   <ul<?php $this->html('userlangattributes') ?>>
      <?php foreach ($this->data['namespace_urls'] as $key => $link ): ?>
         <li <?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php if ( isset ( $link['img'] ) ) { ?><img src="<?php echo $wgStylePath; ?>/chihuahua/images/<?php echo htmlspecialchars( $link['img'] ) ?>" /><?php }; ?></a></li>
      <?php endforeach; ?>
   </ul>
</div>
<?php
            break;
            case 'VARIANTS':
?>
<div id="p-variants" class="vectorMenu<?php if ( count( $this->data['variant_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
   <h5><?php $this->msg('variants') ?></h5>
      <ul<?php $this->html('userlangattributes') ?>>
         <?php foreach ($this->data['variant_urls'] as $key => $link ): ?>
            <li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><img src="<?php echo $wgStylePath; ?>/chihuahua/images/<?php echo htmlspecialchars( $link['img'] ) ?>" /></a></li>
         <?php endforeach; ?>
      </ul>
</div>
<?php
            break;
            case 'VIEWS':
?>
<div id="p-views" class="vectorTabs<?php if ( count( $this->data['view_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
   <h5><?php $this->msg('views') ?></h5>
   <ul<?php $this->html('userlangattributes') ?>>
      <?php foreach ($this->data['view_urls'] as $key => $link ): ?>
         <li<?php echo $link['attributes'] ?>>
            <?php if ( isset ( $link['href'] ) ) { ?><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php if ( isset ( $link['img'] ) ) { ?><img src="<?php echo $wgStylePath; ?>/chihuahua/images/<?php echo htmlspecialchars( $link['img'] ) ?>" /><?php }; ?></a><?php }; ?>
         </li>
      <?php endforeach; ?>
   </ul>
</div>
<?php
            break;
            case 'ACTIONS':
?>
<div id="p-actions" class="vectorMenu<?php if ( count( $this->data['action_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
   <h5><?php $this->msg('actions') ?></h5>
      <ul<?php $this->html('userlangattributes') ?>>
         <?php foreach ($this->data['action_urls'] as $key => $link ): ?>
            <li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><span><img src="<?php echo $wgStylePath; ?>/chihuahua/images/<?php echo htmlspecialchars( $link['img'] ) ?>" /></span></a></li>
         <?php endforeach; ?>
      </ul>
</div>
<?php
            break;
            case 'PERSONAL':
?>
<div id="p-personal" class="<?php if ( count( $this->data['personal_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
   <h5><?php $this->msg('personaltools') ?></h5>
   <ul<?php $this->html('userlangattributes') ?>>
      <?php foreach($this->data['personal_urls'] as $key => $item): ?>
         <li <?php echo $item['attributes'] ?>><a href="<?php echo htmlspecialchars($item['href']) ?>"<?php echo $item['key'] ?><?php if(!empty($item['class'])): ?> class="<?php echo htmlspecialchars($item['class']) ?>"<?php endif; ?>><?php echo htmlspecialchars($item['text']) ?></a></li>
      <?php endforeach; ?>
   </ul>
</div>
<?php
            break;
            case 'SEARCH':
?>
<div id="p-search">
   <form action="<?php $this->text( 'wgScript' ) ?>" id="searchform">
      <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
      <?php if ( false ) : // $wgVectorUseSimpleSearch ): ?>
      <div id="simpleSearch">
         <input id="searchInput" name="search" type="text" <?php echo $this->skin->tooltip( 'search' ); ?> <?php if( isset( $this->data['search'] ) ): ?> value="<?php $this->text( 'search' ) ?>"<?php endif; ?> /><br />
         <button id="searchButton" type='submit' name='button' <?php echo $this->skin->tooltip( 'search-fulltext' ); ?>>&nbsp;</button>
      </div>
      <?php else: ?>
      <input id="searchInput" name="search" value="<?php $this->msg( 'searchbutton' ) ?>" type="text" <?php echo ""; //$this->skin->tooltip( 'search' ); ?> <?php if( isset( $this->data['search'] ) ): ?> value="<?php $this->text( 'search' ) ?>"<?php endif; ?> onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" /><br />
      <!--<input type='submit' name="go" class="searchButton" id="searchGoButton"   value="<?php $this->msg( 'searcharticle' ) ?>"<?php echo $this->skin->tooltip( 'search-go' ); ?> />
      <input type="submit" name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg( 'searchbutton' ) ?>"<?php echo $this->skin->tooltip( 'search-fulltext' ); ?> />-->
      <?php endif; ?>
   </form>
</div>
<?php

            break;
         }
         echo "\n<!-- /{$name} -->\n";
      }
   }

}

