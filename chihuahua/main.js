/**
 * Chihuahua JavaScript functions
 * (C) Copyright 2010 Sayak Banerjee <sayakb@kde.org>
 */

// Function to align the sidebar
$ = jQuery
var maxEntries;

function setSidebar() {
    if (getCookie('kde_userbase_sidebar_position') == 'left') {
        var contentPos = $('#content').position().left;
        var contentSize = $('#content').width();
        var barPos = $('#sidebar').offset().left;
        var barSize = $('#sidebar').width() + contentPos;

        $('#sidebar').css({
            position: 'absolute',
            left: (contentPos + 25) + 'px'
        });

        $('#content').css({
            position: 'absolute',
            left: (barSize - 12) + 'px',
            width: contentSize + 'px'
        });
    }
}

// Function to fix screen layout on resizing
function fixLayout() {
    if (getCookie('kde_userbase_sidebar_position') == 'left') {
        var headerLeft = $('#header').position().left;
        var barSize = $('#sidebar').width() + $('#header').position().left - 12;
        var contentWidth = $('#header').width() - $('#sidebar').width() + 27;

        $('#sidebar').css('left', (headerLeft + 25) + 'px');
        $('#content').css({
            left: barSize + 'px',
            width: contentWidth + 'px'
        });
    } else {
        var contentSize = $('#content').width();
        var barPos = $('#sidebar').position().left;

        $('#sidebar').css({
            position: 'absolute',
            left: (contentSize + 12) + 'px'
        });

    }
}

// Function to swap the sidebar
function swapSidebar() {
    if (!$('#sidebar').is(':animated') && !$('#content').is(':animated')) {
        if (getCookie('kde_userbase_sidebar_position') == 'left') {
            var contentPos = $('#content').position().right;
            var contentSize = $('#content').width();
            var barPos = $('#sidebar').position().left;
            var barSize = $('#sidebar').width() + contentPos;

            $('#sidebar').fadeOut('slow', function () {
                $('#sidebar').css({
                    position: 'absolute',
                    left: (contentSize + barPos - 12) + 'px'
                });

                $('#content').css({
                    position: 'absolute',
                    right: contentPos + 'px',
                    width: contentSize + 'px'
                });

                $('#content').animate({
                    left: (barPos - 25) + 'px'
                }, 'slow', function () {
                    $('#content').css({
                        position: 'inherit',
                        width: 'auto'
                    });

                    $('#sidebar').fadeIn('slow');
                });
            });

            setCookie('kde_userbase_sidebar_position', 'right');
        } else {
            var contentPos = $('#content').position().left;
            var contentSize = $('#content').width();
            var barSize = $('#sidebar').width();

            $('#sidebar').fadeOut('slow', function () {
                $('#sidebar').css({
                    left: (contentPos + 25) + 'px'
                });

                $('#content').css({
                    position: 'absolute',
                    left: contentPos + 'px',
                    width: contentSize + 'px'
                });

                $('#content').animate({
                    left: (barSize - 12) + 'px'
                }, 'slow', function () {
                    $('#sidebar').fadeIn('slow');
                });
            });

            setCookie('kde_userbase_sidebar_position', 'left');
        }
    }
}

// Function to hide a long TOC
function hideLongToc() {
    var tocmain = document.getElementById('toc');

    if (tocmain) {
        var count = 0;
        var content = tocmain.innerHTML;
        var toc = tocmain.getElementsByTagName('ul')[0];
        var toggleLink = document.getElementById('togglelink');

        for (var i = 0; i < (content.length - 3); i++) {
            if (content.substr(i, 3) == '<li') {
                count++;
            }
        }

        if (count > maxEntries)

        if (toc && toggleLink) {
            changeText(toggleLink, tocShowText);
            toc.style.display = 'none';
            tocmain.className = 'toc tochidden';
        }
    }
}

// Function to get a cookie's value
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");

        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);

            if (c_end == -1) {
                c_end = document.cookie.length;
            }

            return unescape(document.cookie.substring(c_start, c_end));
        }
    }

    return "";
}

// Function to set a cookie value
function setCookie(c_name, value, expiredays) {
    var exdate = new Date();

    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toUTCString());
}