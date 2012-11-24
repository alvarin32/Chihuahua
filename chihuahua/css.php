<?php
header("Content-type: text/css");
?>

@import url(//fonts.googleapis.com/css?family=Lato);

/* Eric Meyer CSS Reset */
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,legend,table,caption,tbody,tfoot,thead,tr,th,td,hr {
   margin:0;
   padding:0;
   border:0;
   outline:0;
   font-size:100%;
   vertical-align:baseline;
   background:transparent;
}

/*************************************************************
*   Some global tag styling   
*************************************************************/
body { line-height:1; text-align:center; font-family:"Liberation Sans","Bitstream Vera Sans",sans-serif; font-size: 0.85em;}

ol,ul { list-style:none; }

blockquote,q { quotes:none; }

blockquote:before,blockquote:after,q:before,q:after { content:''; content:none; }

blockquote {
   background-image: url("images/30.png");
   font-style: italic;
   padding: 10px;
}

.logo-small {
    margin-right: 6px;
    margin-left: 2px;
}

/* remember to define focus styles! */
:focus { outline:0; }

/* remember to highlight inserts somehow! */
ins { text-decoration:none; }

del { text-decoration:line-through; }

/* tables still need 'cellspacing="0"' in the markup */
table { border-spacing:0; }

hr {
    margin: 0.3em 1em 0.3em 1em;
    height: 1px;
    border: #999999 solid;
    border-width: 0 0 1px 0;
}

/**************************************************************
*     Main style setup        
**************************************************************/
/*Header and footer backgrounds*/
html {
   background: #dbf87c url("images/background.jpg") no-repeat top center;
/*    background: #dbf87c url("images/altbg.png") no-repeat top center; */
   /*load the external image here to stay in sync with the main site*/
}

body {
}

/*Formating and setups*/
.root { 
   display: block; 
   margin: 0 auto; 
   text-align:left; 
   max-width: 1200px;
   position:relative;
   top:0;
   left:0;
}

/**************************************************************************
 * header box styles
 **************************************************************************/

#header {
   height:38px;
   padding: 5px 25px 4px 40px;
   color: #222222;
/*    color: #aa0000; */
}

   #header h1 {
      display: inline;
      margin-left:10px;
      vertical-align: middle;
      font-weight: normal;
      float: left;
      margin-top: 5px;
   }

   #header a, #header a:visited {
      color:#235E9A;
   }

   #header a:hover {
      text-decoration:none;
      color:#235E9A;
   }
   #header img { vertical-align: middle; float: left; }


.subpages {
/*     width: 50px; */
/*     display: flo; */
/*     width: auto; */
    padding-left: 1em;
    padding-right: 1em;
    font-size: 120%;
    line-height: 48px;
    white-space: nowrap;
    text-overflow: ellipsis;
}

#firstHeading {
    display: none;
}


/**************************************************************************
 * content box styles
 **************************************************************************/

#content {
   float: none;
   width: auto;
   margin-bottom:30px;
   margin-left:25px;
   margin-right:255px;
}

  #content a { color:#235E9A; }

   #content a:visited { color: #7e60ba; }
   
   #content ol.references { border-top: 1px solid #222;}
   
   #content #siteNotice {
      border:1px solid #E1EAF2;
      color:#222;
      border-radius:3px;
      -moz-border-radius:3px;
      -webkit-border-radius:3px;
      -khtml-border-radius:3px;
      padding: 8px 8px 8px 8px;
      font-size: 0.9em;
/*      background: url(images/help-about.png) no-repeat 8px 8px; */
      min-height:32px;
      margin:0;
      vertical-align: middle;
   }
   
      #content #siteNotice .floatleft {
         padding:0 10px 0 0;
         margin:0;
      }
      
      #content #siteNotice img {
         vertical-align: middle;
      }
      
   #content #content-info {
      text-align: center;
      font-size: 0.9em;
      padding: 5px;
   }
/* action menu in the headline of the content box */

#mw-head {
   padding-top: 13px;
   padding-bottom: 5px;
}

   #mw-head .selected { text-shadow:#888 0 0 18px; }

   #mw-head ul li { display:inline; }

   #mw-head div .emptyPortlet { display:none; }

      #mw-head div div#p-actions ul { margin-left: 6px; margin-top: 10px; }

   /* Navigation Labels */
   #mw-head h5 { display: none }

#action-navigation { margin-top: 3px; }

   #action-navigation div { float: right; }

      #action-navigation div ul li { width: 24px; height: 24px; overflow: hidden; float: left; margin-right: 4px;  }

         #action-navigation div ul li img{opacity: 0.5; }
         #action-navigation div ul li img:hover{margin-top:-24px; opacity: 1; }
         #action-navigation div ul li img.down, #action-navigation div ul li.selected img{}
         #action-navigation div ul li img.down:hover, #action-navigation div ul li.selected img:hover{margin-top: -24px}
         
         #action-navigation div ul li.selected img { margin-top:-24px;opacity: 0.5; }
         #action-navigation div ul li.selected img:hover { opacity: 1; }

         #ca-unwatch img, #ca-unprotect img, #ca-edit.selected img { margin-top: -24px; }

#right-navigation { }

   #right-navigation div { float: right; margin-top: 1px; }

      #right-navigation div ul li { width: 48px; height: 48px; overflow: hidden; float: left }

         #ca-history img:hover{margin-top:-48px}
         #ca-history img.down, #ca-history.selected img{margin-top: -96px}
         #ca-history img.down:hover, #ca-history.selected img:hover{margin-top: -144px}

#left-navigation { }

   #left-navigation div { float: left; margin-top: -2px; }

   #left-navigation div ul li { width: 48px; height: 48px; overflow: hidden; float: left;}

      #ca-nstab-main img:hover{margin-top:-48px}
      #ca-nstab-main img.down, #ca-nstab-main.selected img{margin-top: -96px}
      #ca-nstab-main img.down:hover, #ca-nstab-main.selected img:hover{margin-top: -144px}

      #left-navigation ul li { width:48px; height:48px; }
   
      #ca-talk img:hover{margin-top:-48px}
      #ca-talk img.down, #ca-talk.selected img{margin-top: -96px}
      #ca-talk img.down:hover, #ca-talk.selected img:hover{margin-top: -144px}
      #ca-talk.new img {margin-top: -192px; }
      #ca-talk.new img:hover {margin-top: -240px; }

      #ca-special img:hover{margin-top:-48px}
      #ca-special img.down, #ca-special.selected img{margin-top: -96px}
      #ca-special img.down:hover, #ca-special.selected img:hover{margin-top: -144px}
   
      #ca-viewsource img:hover{margin-top:-48px}
      #ca-viewsource img.down, #ca-viewsource.selected img{margin-top: -96px}
      #ca-viewsource img.down:hover, #ca-viewsource.selected img:hover{margin-top: -144px}

.mw-pt-languages-list {
font-size:smaller;
}
   

/**************************************************************************
 * sidebar styles
 **************************************************************************/
 
#sidebar {
   display: inline;
   width: 243px;
   position:absolute;
   top:30;
   right:25px;
}

#sidebar.left {
   display: inline;
   margin-right: 25px;
   width: 243px;
}

   #sidebar .sidebar-header {
/*       padding-top:13px; */
      padding-top: 8px;
      text-transform:uppercase;
      color:#555555;
      text-align:center;
/*       height: 54px; */
      height: 100px;
   }

   #sidebar .sidebar-content {
      color:#222;
      max-width:190px;
      min-height:200px;
      text-align:left;
      padding: 5px 7px;
   }

   #sidebar h5 {
      color:#446888;
      font-weight: 700;
      margin-top: 1em;
      padding: 5px 7px;
      background-image:url(images/30.png);
   }

      #sidebar #p-navigation h5 { margin-top: 15px; }

   #sidebar ul { margin: 1em 0; }

      #sidebar ul li {
         padding-left: 1em;
         margin:0.2em;
      }

   #sidebar .languageselector {
      display: block;
      margin-bottom: 0.5em;
   }

      #sidebar .languageselector select {
         width:100%;
         height:2em;
      }

         #sidebar .sidebar-footer ul li {
            margin: 0px;
         }
      
      #sidebar #footer-icons {
         margin: 0px;
      }
      
         #sidebar #footer-icons #footer-icon-copyrightico img {
            width: 184px;
            height: 35px;
         }

a.cp-doNotDisplay { display:none; }

/**************************************************************************
 * main box styles
 **************************************************************************/


a[href] {
   color:#235E9A;
   text-decoration:none;
}

a[href]:hover {
   text-decoration:underline;
}

#main {
 /*text-align:justify;*/

   text-align: left;
   padding:10px 14px 0;
   color:#222;
   position:relative;
   line-height: 1.3em;
}

   #main a.external:before { content:url(images/external.png)" "; }

   #main a.new { color: #cc2200; }

   #main p { padding: 0.5em 0; }

   #main h1,#main h2,#main h3,#main h4,#main h5,#main h6 { 
      font-weight:400; 
      text-align: left;
   }

   #main h1 {
      line-height:130%;
      margin:9px 0px;
      padding-left:0px;
      background-image:url(images/30.png);
      color:#335877;
      font-size: 1.8em;
   }

   .corso-container {
	background-image:url(images/30.png);
   }


   #main h2 {
/*       line-height:130%; */
/*       margin:20px 10px 0px 0px; */
      margin: 8px 10px 0px 0px;
      padding-bottom: 10px;
/*       color:#446888; */
/*       color: #387507; */
      color:#335877;
      font-size: 1.6em;
      text-align:left;
   }

   #main h3 {
      margin:20px 10px 0px 0px;
      padding-bottom: 10px;
/*       color:#557899; */
      color:#335877;
      font-size: 1.4em;
   }

   #main h4 {
      margin:20px 10px 0px 0px;
      padding-bottom: 10px;
/*       color:#557899; */
      color:#335877;
      font-size:1.3em;
   }

   #main h5 {
      margin:20px 10px 0px 0px;
      padding-bottom: 10px;
      color:#557899;
      font-size: 1.2em;  
	  font-weight: bold;
   }

   #main h6 {
      margin:20px 10px 0px 0px;
      padding-bottom: 10px;
      color:#557899;
      font-size: 1.1em;
   }

   #main > h1,#main > h2,#main > h3,#main > h4,#main > h5,#main > h6 { margin-left: 0px; }

   #main .thumbborder {
      margin:10px;
      padding:5px;
      background-image:url(images/30.png);
      border:1px solid #aaa;
      border-radius:3px;
      -moz-border-radius:3px;
      -webkit-border-radius:3px;
      -khtml-border-radius:3px;
   }
   
   #main div.thumbinner {
   }
   
   #main div.thumb {
      margin-bottom: .5em;
      width:auto;
      background-image:url(images/30.png);
   }

   #main div.tright {
      float: right;
      margin: .5em 0 .8em 1.4em;
   }

   #main div.tleft {
      float: left;
      margin: .5em 1.4em .8em 0
   }

   #main .thumbcaption {
      border: none;
      text-align: left;
      line-height: 1.4em;
      padding: 3px !important;
      font-size: 94%;
   }
   #main div.magnify {
      float: right;
      border: none !important;
      background: none !important;
   }
   #main div.magnify a, #main div.magnify img {
      display: block;
      border: none !important;
      background: none !important;
   }

   #main h2 img {
      vertical-align: bottom;
   }
   

/**************************************************************************
 * main box: list styles
 **************************************************************************/

   #main dl { padding:10px 0; }
      
      #main dl dt {
         font-weight: bold;
         color:#235E9A;
      }
      
      #main dl dd {
         margin-top:2.5px;
         padding-left:30px;
      }
      

   #main li li {
   }
   
   #main ol, #main ul {
      list-style-position: outside;
      padding-left: 40 px;
   }

   #main ol { 
      list-style-type: decimal;
   }

   #main ol ol {
      list-style-type: lower-alpha;
   }

   #main ul { 
      list-style-image:url(images/list-circle.png);
      list-style-type:circle;
   }
   
   #main li {
      margin-top: 10px;
      margin-left: 2em; /* MY EDIT FIXME */
   }

   #main ul:first-child, 
   #main ol:first-child {
      margin-top: 0;
   }

      #main li ul { 
          list-style-image:url(images/list-square.png);
         list-style-type:square; 
      }

         #main li ul>li:hover { 
            list-style-image:url(images/list-square-over.png);
         }
         
      /* ToC w/o bullets */
      #main #toc ul, #main #toc li:hover { list-style: none; }

      #main #toctitle h2 { margin: 0px 10px 10px 0; }
      
   #main form, #main fieldset.prefsection, #main .prefsection fieldset {
      padding:5px;
      border:1px solid #F1FAF2;
      box-shadow:0 2px 3px #888;
      border-radius:5px;
      -moz-border-radius:5px;
      -webkit-border-radius:5px;
      -khtml-border-radius:5px;
   }
   
   #main fieldset.prefsection, #main .prefsection fieldset {
	  margin-bottom:10px;
   }
   
   #main .prefsection legend {
	  color:#235E9A;
	  margin-bottom:2px;
   }
   
   #main fieldset.prefsection {
	  padding-top:10px;
   }
   
   #main #preftoc {
      padding-left: 0;
      padding-bottom: 10px;
   }

      #main #preftoc li {
        display:inline-block;
        padding-right: 1em;
      }
   
         #main #preftoc li a {
            background-image:url("images/30.png");
            width: 100%;
         }
         
         #main #preftoc li a:hover {
            background-image:url("images/30s.png");
         }
         
         #main #preftoc .selected a {
            font-weight:bold;
         }

   #main table {
      color:#222;
      border-radius:3px;
      -moz-border-radius:3px;
      -webkit-border-radius:3px;
      -khtml-border-radius:3px;
   }

   #main table.tablecenter {
      margin-left:auto;
      margin-right:auto;
   }

      #main table th {
         color:#222;
         background-color:#E1EAF2;
         padding:5px;
         text-align:center;
      }

      #main table td { 
         padding:6px; 
         vertical-align: top; 
         text-align:left;
      }
      
      #main table td[align=right] { text-align:right; }

   #main table.donations-and-sponsors td { vertical-align:middle; }

   #main table.toc { width:auto; }

   #main sup {  }

   #main sub {  }

   #main pre {
      font-style:monospace;
      color:#555;
      padding:2px 5px 2px 20px;
      border:1px solid #DDD;
      background: rgba(255, 255, 255, 0.5);
   }
   
   #main .mw-geshi { border: 1px solid #DDD; background: rgba(255, 255, 255, 0.5); }
   
   #main .mw-geshi pre { border: none; background: transparent; }
   
/* Download button */
   #main a.downloadButton {
      display:block;
      width:130px;
      height:61px;
      background:url(/images/buttons/download_empty.png);
      text-align:center;
      padding:40px 10px 15px 130px;
      line-height:20px;
      margin-left:auto;
      margin-right:auto;
      vertical-align:middle;
      color:#222;
   }

   #main a.downloadButton:hover { text-decoration:none; }


.corsotitolo {
    border-bottom:none;
    font-size:130%;
    padding:.15em .4em;
    line-height: 0.4em;
    padding-top: -10px;
}

/* .contributionscores .header { background-color: #cccccc; border-bottom: 1px solid #999999; font-weight: bold; } */

   
.table-wrapper { padding:15px; }

/* Application pages */
#sidebar a { text-decoration:none; line-height: 1.3em; }

.app-icon { float:left; }

.app-screenshot { clear:left; text-align:center; }

.infobox { padding-top:15px; }

#infobox-return img,.header-image {
   padding:0!important;
   border:0!important;
   margin:0 5px 0 0!important;
   background-image:none!important;
}

#contentSub {
   margin-top: 5px;
   text-align: center;
}


/**************************************************************************
 * ??? styles
 **************************************************************************/

.mw-history-legend { padding: 5px; }

   #mw-history-search legend { font-weight: bold; line-height: 150%; }

#pagehistory { padding-left: 0px !important; }

   #pagehistory li.selected { font-weight: bold; background-color: rgba(249, 249, 249, 0.8) !important ; }

   #pagehistory li { padding: 5px; list-style: none inside; }

#editform, #toolbar, #wpTextbox1 {
   clear: none !important;
}

input#wpSummary { width: 100% !important; }

/* this class could be useful for the introductionary image */
table.teaser { width: 100%; text-align: center; }

#mw-normal-catlinks { clear: both; }

   #main > h2.contributionscores-title {
      background-color: transparent;
      margin: 20px 10px 10px 0;
      padding-left: 0;
   }

/**************************************************************************
 * application box styles (needed?)
 **************************************************************************/
 
.app-category,.international-site {
   float:left;
   display:table-cell;
   max-width:240px;
   width:240px;
   height:60px;
   max-height:60px!important;
   text-align:left;
}

   .app-category img,.international-site img {
      float:left;
      margin:0 10px 0 0!important;
   }

   .app-category a,.international-site a {
      font-weight:700;
      text-decoration:none;
   }

.international-site {
   height:auto!important;
}

.screenshot {
   margin-top:20px;
   margin-botton:20px;
}

.toggle {
   float:right;
   width:auto;
   padding:10px 10px 0;
   color:#888;
   text-shadow:#fff 0 0 3px;
   text-decoration:none;
   font-weight:400;
}

#hotspot {
   float:right;
}

.editsection{
   font-weight:100;
}

.catlinks {
/*  border-top: 1px solid #aaa; */
   padding-top:5px;
   padding-bottom: 10px;
   margin-top:5px;
}

.printfooter {
   margin-top:1em;
   word-wrap: break-word;
   text-align:left;
   display:none;
}

#toolbar {
   clear:left;
   text-align: center;
}

   #toolbar img {
      margin:2px;
      padding:2px;
   }

#editform {
   clear:left;
   width:auto;
   padding:5px;
}

   #editform textarea {
      width:100%;
   }

#p-search {
   float: right;
   margin-bottom: 3px;
   margin-top: 3px;
   margin-right:14px;
}

#searchInput {
   border: 1px solid #aaa;
   color: #aaa;
   width:212px;
}

#searchInput:hover {
   border: 1px solid #777;
   color: #777;
}

#searchInput:focus {
   border: 1px solid #555;
   color: #555;
}

/**************************************************************************
 * footer box styles
 **************************************************************************/

#footer {
   color:#666;
   width:100%;
   padding:15px 0 10px;
   text-align:center;
   font-size: 0.9em;
   margin-top: 0px;
}

   #footer a, #footer a:visited { color:#222; }

   #footer ul { list-style-type:none; padding-bottom:0.1em;}

      #footer ul li { padding: 0 0; display:inline;list-style-position:inside;}
      #footer ul li:before { content:"   ∗   "; }
      #footer ul li:first-child:before { content:""; }



#pt-newmessages.active a { color: #C20; font-weight: bold; }

.menuchoice, .keycap {
   font-weight: normal;
   color:#222222;
   background-color: #cccccc;
   padding: 0 5px;
}

#main .plainlinks a.external::before {
	content: none;
}

.visualClear { clear: left; }

<?php
  include "wrapper.css";
  include "ocs.css";
?>


/* obsolete; replaced with icons

#content .menu_box {
text-align:center;
min-height:50px;
padding: 10px 15px 3px 15px;
text-shadow:#fff 0 0 3px;
}

#content .menu_box ul {
display:inline;
}

#content .menu_box li {
display:inline;
margin:3px 4px;
}

#content .menu_box li a {
text-decoration:none;
margin:0 6px;
color:#555;
font-size:14px;
font-weight:400;
padding-left:3px;
text-transform:uppercase;
}


#content .menu_box li a:hover h2, 
#content .menu_box li a:hover, 
#content .menu_box li a#current {
color:#222;
text-shadow:#E6F1FF 0 0 3px;
background-image:url(images/underline.png);
background-repeat:repeat-x;
background-position:bottom;
}

/* deeper level obsolete
  #content .menu_box li ul {
  padding-top:5px;
  padding-left:10px;
  }

  #content .menu_box li ul li {
  float:none;
  text-align:left;
  margin:5px 0;
  }

  #content .menu_box li ul li a {
  color:#666;
  font-size:12px;
  margin:5px;
  }

  #content .menu_box li ul li ul {
  margin:4px 2px 4px 10px;
  padding:0;
  }

  #content .menu_box li ul li ul li {
  margin:2px;
  padding:0;
  }
*/

/*Header glow/icons
#ca-nstab-main {
background-image:url(images/icon-2.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-talk {
background-image:url(images/icon-9.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-edit, #ca-viewsource, #ca-addsection {
background-image:url(images/icon-6.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-history {
background-image:url(images/icon-1.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-delete {
background-image:url(images/icon-7.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-move {
background-image:url(images/icon-4.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-protect {
background-image:url(images/icon-5.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-watch, #ca-unwatch {
background-image:url(images/icon-3.png);
background-repeat:no-repeat;
background-position:0 0;
}

#ca-special, #ca-nstab-user {
background-image:url(images/icon-10.png);
background-repeat:no-repeat;
background-position:0 0;
}


*/


