<div class="message-wrapper" id="dialog1">
<div class="message" id="message">
	<i class="fa fa-close" onclick="this.parentElement.parentElement.style.display='none'"></i>
	<div class="messagecontent" id="msg1"></div>
</div>
</div>


<script>
function myFunction(x) {
document.getElementById("mobile-menu").innerHTML=document.getElementsByClassName("menu")[0].innerHTML;
  x.classList.toggle("change");
  $(".mobile-menu-wrapper").toggleClass("show-mobile-menu");
}
function showSubMenu(id){
	$('#'+id+' i.fa-angle-right').toggleClass('fa-angle-down');
	$('#'+id+' .sub-menu').toggleClass('mobile-submenu-show');
}
function Dialog(msg){
	$("#msg1").html(msg);
	$("#dialog1").css("display","block");
}
function Dialog2(d,m,msg){
	$("#"+m).html(msg);
	$("#"+d).css("display","block");
}
</script>
</body>
</html>