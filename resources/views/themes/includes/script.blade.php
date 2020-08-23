<!-- SCRIPTS -->
<script src="{{ asset('themes/assets/js/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('themes/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/assets/js/webslidemenu.js') }}"></script>
<script src="{{ asset('themes/assets/vendors/owcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('themes/assets/vendors/jcarousellite/jquery.jcarousellite.js') }}"></script>
<script src="{{ asset('themes/assets/js/index.js') }}"></script>
<script>
    $('#submitregister').click(function() {
        var email =  $('#myModalRegister [name="email"]').val();
        var password =  $('#myModalRegister [name="password"]').val();
        var confirmpassword =  $('#myModalRegister [name="confirmpassword"]').val();
        var full_name =  $('#myModalRegister [name="full_name"]').val();
        var phone =  $('#myModalRegister [name="phone"]').val();
        var city =  $('#myModalRegister [name="city"]').val();
        var address =  $('#myModalRegister [name="address"]').val();
        $.ajax({
            url: '{{url('member/register')}}',
            dataType: "json",
            type: "post",
            data: {_method: 'post', _token: '{{csrf_token()}}',email:email,password:password,full_name:full_name,phone:phone,city:city,address:address,confirmpassword:confirmpassword}
        }).done(function (data){
          if(data.check==false){
              $('#myModalRegister [name="message"]').css("display","block");
              $('#myModalRegister [name="message"]').html(data.message);
          }else{
              window.location.href = data.redirect;
          }
        }).fail(function (data) {
            alert('Lỗi gửi dữ liệu');
        });
    });
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-87490280-2', 'auto');
    ga('send', 'pageview');
</script>
<script src="//rum-static.pingdom.net/pa-5e9bdc9c11c0700008000922.js" async></script>

