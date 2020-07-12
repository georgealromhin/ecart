
    var t=$(window).height()/2;
    $(window).on("scroll",function(){$(this).scrollTop()>t?$("#back_to_top").css("display","flex"):$("#back_to_top").css("display","none")}),$("#back_to_top").on("click",function(){$("html, body").animate({scrollTop:0},300)})
    function openNav() {
      document.getElementById("main-sidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("main-sidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }
    
    function increase(t,e,o){
        $(e).val(parseInt($(e).val())+1);var s=parseFloat($(e).val())*t;$(o).text(s)
    }
    function decrease(t,e,o){
        var a= 1;
        $(e).val(parseInt($(e).val())-1),$(e).val()<a&&$(e).val(a);var s=parseFloat($(e).val())*t;$(o).text(s)
        // $(e).val(parseInt($(e).val())-1),$(e).val()<a&&$(e).val(a);var s=parseFloat($(e).val())*t;$(o).text(" "+s.toFixed(2).replace(".",","))
    }

$( document ).ready(function() {

    $(".add-to-cart").click(function(){
        var itemid = this.id;
        qty=$("#qty"+itemid).val();
        $('#'+itemid).prop('disabled', true);
        $.ajax({
            type:"GET",
            url:"cart/store/"+itemid+"/"+qty,
            success:function(t){
                $('.toast').toast('show');
                getTotalPrice();
                $('#'+itemid).prop('disabled', false);
            
            },error:function(t,e,o){
                $('#'+itemid).prop('disabled', false);
            }
        })
    });

getTotalPrice();
function getTotalPrice(){
$.ajax({
type:"GET",
url:"total",
success:function(t){
$('#cart-total').text(t);
},error:function(t,e,o){
console.log(t);
}
})  
}


});    