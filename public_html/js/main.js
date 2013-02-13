(function (document, navigator, standalone) {
  // prevents links from apps from oppening in mobile safari
  // this javascript must be the first script in your <head>
  if ((standalone in navigator) && navigator[standalone]) {
    var curnode, location = document.location, stop = /^(a|html)$/i;
    document.addEventListener('click', function (e) {
      curnode = e.target;
      while (!(stop).test(curnode.nodeName)) {
        curnode = curnode.parentNode;
      }
      // Condidions to do this only on links to your own app
      // if you want all links, use if('href' in curnode) instead.
      if ('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) )) {
        e.preventDefault();
        location.href = curnode.href;
      }
    }, false);
  }
})(document, window.navigator, 'standalone');


function refreshMovie(movieId) {
  var loaderImage = '/images/design/ajax_loader.gif';
  var height = $('#' + movieId).height();
  var marginTop = height / 2 - 77;
  $('#' + movieId).html('<div style="text-align: center; height:' + height + 'px;"><img src="' + loaderImage + '" alt="loading" style="margin-top:' + marginTop + 'px" /></div>');
  $.ajax({
    url:"/",
    type:"post",
    data:{
      movieId:movieId
    },
    success:function (data) {
      $('#' + movieId).html($(data).html());
    }
  });

}