jQuery(function(){
  $('#formdate').datepicker({
    dateFormat: 'MM dd, yy',
    minDate: new Date()
  });
  $('.formborder > select').mSelect();
  $('.pagesort > select').mSelect();
  if($.browser.msie && $.browser.version < 9){
    $('.resultitems').find('.item:last-child').css({
      'background': 'none',
      'padding-bottom': '41px'
    });
  }
  $('.available').find('input:checked + label').addClass('selectroom');
  $('.available').find('label').click(
    function(){
      var p = $(this).parent().parent();
      p.find('label').removeClass('selectroom');
      p.find('input:radio').removeAttr('checked');
      $(this).addClass('selectroom').prev('input').attr('checked','checked');
    }
    );
  $('.partytime').find('input:checked + label').addClass('selecttime');
  $('.partytime').find('label').click(
    function(){
      var p = $(this).parent();
      p.find('label').removeClass('selecttime');
      p.find('input:radio').removeAttr('checked');
      $(this).addClass('selecttime').prev('input').attr('checked','checked');
    }
    );
  $('.formborder').find('label').click(
    function(){
      var s = $(this).parent().find('select')
      s.click();
    }
    );
  $('.formborder').find('slect').focus(
    function(){
      alert('Hi');
    }
    );
  $('a[rel*=lightbox]').lightBox();
  var pm = $('#pagemenu');
  if(pm.length){
    pm.css('margin-bottom',0).addClass('wrap');
    pm.parent().find('.detail').css('margin-bottom','111px');
    menupos = pm.position().top + 278;
    pm.wrap('<div>').parent().css({
      'position':'fixed',
      'top':menupos+'px',
      'width':'100%',
      'left':0
    });
    $(window).scroll(
      function(){
        var t = menupos -$(this).scrollTop();
        pm.parent().css('top',t>0?t:0);
      });
  }
});
var menupos = 0;
function selectChange(el){
  var c = $(el);
  c.parent().find('label').html(c.find('option:selected').html());
}
function inviteFocus(el){
  var v = $(el);
  if(v.length>0 && v.val() == 'enter your friend\'s email address')
    v.val('');
}
function inviteBlur(el){
  var v = $(el);
  if(v.length>0 && v.val() == '')
    v.val('enter your friend\'s email address');
}
function ClearAll(el){
  var f = $(el).parent();
  if(f.length>0){
    f.find('input:text').val('');
    f.find('select > option:selected').removeAttr('selected');
    f.find('input:radio').removeAttr('checked');
    f.find('.mSelected').html('');
  }
}
function showDetail(el){
  var f = $(el).parent().parent().find('.detail:hidden');
  if(f.length>0){
    f.slideDown('slow');
  }else{
    f = $(el).parent().parent().find('.detail:visible');
    if(f.length >0 ){
      f.slideUp('slow');
    }
  }
}
