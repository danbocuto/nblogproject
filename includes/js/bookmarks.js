/*

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program. If not, see <http://www.gnu.org/licenses/>.

 --------------------------------------------------------------------

 Quick social bookmarks Version: 1.1.0b
 Download, support, contact: http://www.spyka.net
 (c) Copyright 2008, 2009 spyka Web Group

*/


var settings = [{
 'html_before':'',
 'html_after':'',
 'imagepath':'/images/icons/'
}]


/* bookmarks:
 syntax:
 new Array(Bookmark Submit URL, Bookmark name, Icon image name),

 use {url} in bookmark URL to insert current url
 use {title} in bookmark URL to insert current page title
*/
var sites = [

 new Array('http://del.icio.us/post?url={url}&title={title}', 'Del.icio.us', 'delicious.png'),
 new Array('http://reddit.com/submit?url={url}&title={title}', 'reddit', 'reddit.png'),
 new Array('http://furl.net/storeIt.jsp?t={title}&u={url}', 'Furl', 'furl.png'),
 new Array('http://www.stumbleupon.com/submit?url={url}', 'Stumble', 'stumble.png'),
 new Array('http://digg.com/submit?phase=2&url={url}', 'Digg', 'digg.png'),
 //new Array('http://www.mixx.com/submit?page_url={url}&title={title}', 'Mixx', 'mixx.png'),
 //new Array('http://www.technorati.com/faves?add={url}', 'Technorati', 'technorati.png'),

]


//////////////////////////////////////////
// END EDITS HERE
//////////////////////////////////////////
function swgbookmarks()
{
 for(i = 0; i < sites.length; i++)
 {
 var g = sites[i];
 var u = g[0];
 u = u.replace('{url}', escape(window.location.href));
 u = u.replace('{title}', escape(window.document.title));
 var img = (settings[0].imagepath == '0') ? '' : '<img src="'+settings[0].imagepath+g[2]+'" alt="'+g[1]+'" /> ';
 var k = '<a href="'+u+'">'+img+'</a>';
 window.document.write(settings[0].html_before+k+settings[0].html_after);
 }
}