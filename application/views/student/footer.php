<div id="dialog-confirm" class='jquery-dialog' title="Delete this Item?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:28px 12px 20px 0;"></span> <br>Deleted Data cannot be restored. Are you sure?</p>
</div>
<div id="alertDialog" class='jquery-dialog' title="Message"></div>

<div id='loading'>
	<div id="loading-wrapper"></div>
	<i class='fa fa-spinner fa-spin loading'></i>
	<div  id="loadingtext">Loading...</div>
</div>
<div class="modal" id="modalDialog" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
         
        </div>
      </div>
    </div>
</div>

<script>
var baseurl="<?=base_url()?>";
function openModal(options){
	if(options.title!=undefined){$("#modalDialog .modal-title").text(options.title);}
	if(options.content!=undefined){$("#modalDialog .modal-body").html(options.content);}
	if(options.width!=undefined){$("#modalDialog .modal-dialog").css("width",options.width);}
	$("#modalDialog").modal({});
}

if(sessionStorage.getItem("shown")==null){
	$.get({url:baseurl+"student/getlatestlectures",dataType:'json',success:function(data){
		showLectures(data);
	}})
}

$("#modalDialog").on("hide.bs.modal",function(e){
	setShown();
});


function setShown(){
	sessionStorage.setItem("shown","yes");
}

function showLectures(data){
	if(data.length==0)return;
	var table="<table class='sc-table'><tr><th>Name</th><th>Subject</th></tr>";
	for(let d of data){
		let tr="<tr>";
		tr+="<td>"+d.title+"</td>";
		tr+="<td>"+d.subject+"</td>";
		tr+"</tr>";
		table+=tr;
	}
	table+="</table>";
	var button="<div class='text-center' style='margin-top:10px'><a onclick='setShown()' class='btn btn-primary btn-sm' href='"+baseurl+"student/videolectures'>Visit Lectures</a></div>";
	openModal({title:'Lectures Uploaded Today',content:table+button});
}

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