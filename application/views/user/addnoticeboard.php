<style>
	.fa-minus-square,.fa-plus-square{
		font-size: 20px;
		margin-top: 5px;
		margin-right: 4px;
	}
</style>

 <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ruq98uymgipvjwwsmgyh10anvp4ctfjjuxvs7ariqle7s7wg"></script>
  <script>
	tinymce.init({
		selector: 'textarea',
		height: 300
	});
  </script>

<div id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Post New Noticeboard</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>user/savenoticeboard" method="post">
							<div class='form-group'>
								<textarea id="content"></textarea>
							</div>
<div id="base">
	<div class="row">
		<div class="col-sm-3 wp">
		<div class="form-group">
		<label>Select Course</label>
			<select id="course" name="cid[]" class="w3-input w3-border course" onchange="loadBatches(this.value,batch)">
			<option value="">Select Course</option>
			<?php 
			foreach ($courses as $v) {
				echo "<option value='$v->id'>$v->course</option>";
			}
			?>
			</select>
		</div>
		</div>
		<div class="col-sm-3 wp pl">
			<div class="form-group">
				<label>Select Batch</label>
				<select id="batch" name="bid[]" class="w3-input w3-border batch">
				<option value="">Select Batch</option>
				</select>
			</div>
		</div>

		<div class="col-sm-1 col-xs-2 wp pl">
			<label> &nbsp;</label><br>
			<i class="fa fa-plus-square" onclick="addMore()"></i><p></p>
		</div>
		
	</div>
</div>
<div id="sample"></div>



							<div class='form-group'>
								<input type="submit" value="Submit" class='w3-btn b-primary' >
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>

$('#form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                formData.append("content",getContent());
                $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data:formData,
                dataType:'json',
                contentType: false,
                processData: false,
                success: function(data) {
                if(data.status=="ok"){
                $("#form").trigger("reset");
                }
               openModal({title:'Status',content:data.message});
                }
               });
  });

function getContent(){
	x = document.getElementById("content_ifr");
	y = (x.contentWindow || x.contentDocument);
	if (y.document){y = y.document;}
	var cont=y.body.innerHTML;
	return cont;
}

var baseurl="<?=base_url()?>";
function loadBatches(cid,ele){
$.post({url:baseurl+"user/getbatchesbycourseid",data:{'cid':cid},success:function(data){
ele.innerHTML=data;
}}); 
}


n=1;
function addMore(){
idd="id_"+n;
n++;
var div=document.createElement("div");
div.setAttribute("id",idd);
ele=document.querySelectorAll(".batch");
lastbatchid=ele[ele.length-1].getAttribute("id");

var rand=Math.floor(Math.random() * 100000);

str=base.innerHTML.replace('id="batch"','id="'+lastbatchid+rand+'"');

str=str.replace('onchange="loadBatches(this.value,batch)"','onchange="loadBatches(this.value,'+lastbatchid+rand+')"');

str=str.replace("<p></p>","<i class='fa fa-minus-square' onclick=\"sample.removeChild(document.getElementById('"+idd+"'))\"></i>");

div.innerHTML=str;
sample.appendChild(div);

}


</script>

