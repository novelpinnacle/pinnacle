<style>
#myProgress {
  display: none;
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 0%;
  height: 8px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}
</style>
<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Upload Workshop Updates</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>erp/saveworkshopupdates" autocomplete="off">
				<div class="row">
					<div class='col-sm-3 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Select Date <span>*</span> </label>
							<input type="text" name="date" class="w3-input w3-border datepicker" required>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Main Image?</label><br>
							<input type="checkbox" name="mainimage" value="1">
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class="form-group">
							<label>Choose File</label>
							<input type="file" id="imagefile" onchange="$('#showselected').html('Selected File:<b> '+this.files[0].name+'</b>')" name="file" style="position:absolute;left:-2000px">
								<input type="button" value="Choose File" onclick="imagefile.click()" class="btn btn-default btn-sm btn-block">
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class="form-group">
						<label>&nbsp; </label><br>
							<input type="submit" value="Submit" class="btn btn-default btn-sm btn-block">
						</div>
					</div>

					<div class="col-sm-8 wp pr"> </div>
					<div class="col-sm-12 wp pr">
						<div id="showselected"></div>
						<div id="myProgress">
							<div id="myBar"></div>
						</div>
						<h4 id="progressstatus"></h4>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>

$('#form').submit(function(evt) {
    evt.preventDefault();
    if(document.getElementById("imagefile").files.length==0){
    	openModal({title:'Alert',content:'<b class="w3-text-red">Please Choose Excel File</b>'});
    	return;
    }
    $("#form input[type=submit]").attr("disabled",true);
	var formdata = new FormData(this);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", $(this).attr('action'));
	ajax.send(formdata);
 });
function progressHandler(event){
	$("#myProgress").css("display","block");
	var percent = (event.loaded / event.total) * 100;
	$("#myBar").css("width",Math.round(percent)+"%");
	$("#myBar").text(Math.round(percent)+"%");
	$("#progressstatus").html("Uploaded "+event.loaded+" bytes of "+event.total);
}
function completeHandler(event){
	$("#myBar").css("width","0%");
	$("#myProgress").css("display","none");
	$("#progressstatus").html("");
	$("#showselected").html("");
	$("#form input[type=submit]").attr("disabled",false);
	openModal({title:'Status',content:JSON.parse(event.target.responseText).message});
}
function errorHandler(event){
	openModal({title:'Status',content:"Error Occured"});
}
function abortHandler(event){
	openModal({title:'Status',content:"Cancelled Or Aborted"});
}
</script>