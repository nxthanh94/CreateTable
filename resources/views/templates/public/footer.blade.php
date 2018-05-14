<section class="footer-home">
    <div class="container">
        <div class="row mm-footer">
            <div class="col-12 col-sm-6 col-md-3 ">
                <div>
                    <div class="footer-conten">
                        <h3>Hotline</h3>
                        <p><i class="fa fa-volume-control-phone" aria-hidden="true"></i><span>{{ $arCaiDat['name9']}}</span></p>
                        
                    </div>
                    <div class="footer-conten">
                        <h3>Địa Chỉ</h3>
                        <p><i class="fa fa-map-signs" aria-hidden="true"></i><span>{{ $arCaiDat['name8']}}</span></p>
                        
                    </div>
                    <div class="footer-conten">
                        <h3>Giờ Mở Cửa</h3>
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i></i>{{ $arCaiDat['name1']}}</p>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-md-3 ">
                <div class="">
                    <div class="footer-conten">
                        <h3>Facebook</h3>
                        <div class="fb-page" data-href="{{ $arCaiDat['name3']}}" data-tabs="timeline" data-height="285" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{ $arCaiDat['name3']}}" class="fb-xfbml-parse-ignore"><a href="{{ $arCaiDat['name3']}}">Công Ty</a></blockquote></div>
                    </div>

                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-md-3 ">
                <div class="">
                    <div class="footer-conten">
                        <h3>Công Ty</h3>
                        <p><i class="fa fa-building"></i>{{ $arCaiDat['name10']}}</p>
                    </div>
                    <div class="footer-conten">
                        <h3>Email</h3>
                        <p><i class="fa fa-envelope-o"></i>{{ $arCaiDat['name11']}}</p>
                    </div>
                </div>
                
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 ">
                <div class="">
                    <div class="footer-conten">
                        <h3>Về Chúng Tôi</h3>
                        <p><a href="">Thông tin về Công Ty</a></p>
                        
                        
                    </div>
                    <div class="footer-conten">
                        <h3>Liên Hệ Thắc Mắc</h3>
                        <p>{{ $arCaiDat['name2']}}</p>
                    </div>
                </div>
                
            </div>
            
        </div>  
    </div>
</section>

<script type="text/javascript">
    var showsearch ="true";
</script>
<script>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

                // Variables privadas
                var links = this.el.find('.link');
                // Evento
                links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
            }

            Accordion.prototype.dropdown = function(e) {
                var $el = e.data.el;
                $this = $(this),
                $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                    $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
                };
            }   

            var accordion = new Accordion($('#accordion'), false);
        });
    </script>
    
    <script>
        (function() {
            var mainMenu = getDDMenu(document.querySelector('#dd-menu'), {
                effect: 'slideFromLeft'
            });

            var mainMenuItems = new DDMenuItems(mainMenu);
        })();
    </script>
    <script src="{{ $url_public }}/js/homev2.js"></script>
</body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=1873419896211314&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</html>