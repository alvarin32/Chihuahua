<?php
header("Content-type: text/css");
?>

/***************************************************
 * This file provides classes to style the content
 **************************************************/

#main table.vertical-centered td, #main table.vertical-centered th {
   vertical-align:middle;
}

#main table th {
  text-align: left;
}

#main table tr td h4 {margin:0; padding: 0; }

.searchtypes div, .mw-search-formheader div {
   clear: left !important ;
}

.searchresults p {
  margin-bottom: 0;
}

body.ltr .magnify {
   float:left;
}

#main code {
   background-color: lemonchiffon;
   border: 1px dotted #BCBCBC;
   padding-left: 0.5em;
   padding-right: 0.5em;
}

#main code.input {
   background-color: lemonchiffon;
}

#main code.output {
   background-color: gainsboro;
}

/**************************************************************************
 * common MW styles
 **************************************************************************/

.clear {
   clear: both;
}

.floatleft {
   float:left;
   margin:5px 10px 5px 0;
}

.floatnone {
   float:none;
}

.floatright {
   float:right;
   margin:5px 0px 5px 10px;
}

.center * {
   text-align:center;
   margin: 0px auto;
}

div.center + p {
  clear: left;
}

.fullImageLink a img {
   max-width: 100%;
}

.even {
  background-image:url(images/30.png);
}

table.wikitable {
  margin: 0;
  width: 100%;
  background: transparent;
}
   table.wikitable tr {
     border-color: inherit;
   }
   
table[border=1] {
  border: 1px solid #808080;
  border-color: rgba(128, 128, 128, 0.6);
}

#main pre {
   word-wrap: break-word;
   white-space: pre-wrap; 
}

#main pre pre {
   border: none;
}

h2#filehistory {
  clear: none;
}

form#powersearch {
clear: none;
}

/**************************************************************************
 * templates
 **************************************************************************/

.rbroundbox {
  background-image:url(images/30.png);
  border-right: 1px solid #f5f6fa;
  border-left: 1px solid #f5f6fa;
}

.rbtopwrap {
  background-image:url(images/30.png);
  text-align: center;
  font-weight: bold;
  padding:5px;
}

.rbbot {
   clear: left;
   border-bottom: 1px solid #f5f6fa;
}

.rbcontent {
   padding: 5px 20px 5px 10px;
}

   .rbcontent .floatleft {
      padding-bottom: 5px;
   }

.infobox {
  vertical-align: top;
  background-color:#ccccff;
}

#main table.gallery {
  margin-left:auto;
  margin-right:auto;
}

[lang="ar"] a, [lang="ckb"] a, [lang="fa"] a, [lang="kk-arab"] a, [lang="mzn"] a, [lang="ps"] a, [lang="ur"] a {
    text-decoration: none;
}
