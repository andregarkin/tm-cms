
/* ==============================================
TM CMS Custom JS
=============================================== */  


$(document).ready(function () {
  
  
  /* ==============================================
      Adding Active class to nav
  =============================================== */

  var url = window.location;
  
  $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
  $('ul.nav a').filter(function() {
      return this.href == url;
  }).parent().addClass('active');
  
  /* ==============================================
      Remove Banner Iframe for admin part: /banners, /admin
  =============================================== */
  /*
  var pathname = $(location).attr('pathname'); // index.php | 
  //console.log('pathname: ');
  //console.log(pathname); // '/tm-cms/banners/create.php'
  
  if (pathname.indexOf('/banners') > -1 || pathname.indexOf('/admin') > -1) {
    $('iframe#banner').remove();
    console.log('Banner Iframe tag was removed for this admin page.');
  }
  */
  
});
