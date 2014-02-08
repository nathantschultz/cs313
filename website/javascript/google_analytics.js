/*
 *	This is my google anaylytics script file, needs to be included in each page I want to track 
 */

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38526880-1']);
  _gaq.push(['_setDomainName', 'nathantschultz.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();