$(document).ready(function () {
  var url = 'http://fotogram.com.devel/';

  $('.btn-like').css('cursor', 'pointer');
  $('.btn-dislike').css('cursor', 'pointer');
  //Botton de like
  function like() {

    $(".btn-dislike").unbind('click').click(function () {
      $(this).addClass('btn-like').removeClass('btn-dislike');
      $(this).attr('src', url + 'imgs/kokoroR.png');

      $.ajax({
        url: url + 'like/' + $(this).data('id'),
        type: 'GET',
        success: function (response) {
          if (response.like) {
            console.log('Has dado like a la publicación!');
          } else {
            console.log('Error al dar like!');
          }
        }
      })
      dislike();
    });

  }

  //Botton de dislike
  function dislike() {

    $(".btn-like").unbind('click').click(function () {
      $(this).addClass('btn-dislike').removeClass('btn-like');
      $(this).attr('src', url + 'imgs/kokoroV.png');

      $.ajax({
        url: url + 'dislike/' + $(this).data('id'),
        type: 'GET',
        success: function (response) {
          if (response.like) {
            console.log('Has dado dislike a la publicación!');
          } else {
            console.log('Error al dar dislike!');
          }
        }
      });
      like();
    });

  }
  dislike();
  like();

});