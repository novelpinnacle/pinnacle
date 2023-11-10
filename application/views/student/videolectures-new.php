<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Practice</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<style>
    body{
    	font-family: 'Roboto', sans-serif;
    }
    #accordion{
    	margin-top: 2em;
    }
    #accordion .card{
    	margin-bottom: .35em
    }

    .chapter-item{
    	position: relative;
    	border-radius: .25em;
      border-top-right-radius: 0;
    	padding:10px 25px;
    	color:#fff;
      margin-top: .6em;
    	margin-bottom: 2em;
    	cursor: pointer;
    	font-size: .8em;
    }
    .chapter-item [class*="fa-file"],.chapter-item .fa-check{
    	position: absolute;
    	top:.9em;
    	left:.7em;
    	color:#fff;
    }

    .chapter-item .fa-check{
    	left: initial;
    	top:1em;
    	right:.7em;
    }

    .chapter-item.text-dark{
    	opacity: .5;
    	cursor: not-allowed;
    }

    .disabled{
      opacity: .5;
      cursor: not-allowed;
    }
    .disabled .fa-check{
      display: none;
    }


    .aspect-ratio{
    	position: relative;
    	width:100%;
    	padding-top:56.25%;
    }

    #videoiframe{
    	width:100%;
    	height: 100%;
    	position: absolute;
    	top:0;
    	left: 0;
    }

    .notes-wrapper{
    	width: 100%;
    	height:80vh;
    	position: relative;
    }
    #notesiframe{
    	width: 100%;
    	height: 100%;
    	position: absolute;
    	top:0;
    	left: 0;
    }

    .modal-header{
    	padding:.5em 1em;
    }
    .modal-header h4{
    	font-size: 1.1em;
    }

    .filter{
      background-color: #ddd;
      padding:7px 20px;
      margin-top: 1em;
      color:#252525;
      border-radius: 4px;

    }
    .filter p{
      margin-bottom: 4px;
      font-size:1.2em;
    }
    .filter label{
      font-size: .9em;
      margin-bottom: 0;
    }
    

</style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Online Lectures</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url()?>student">Back to Dashboard</a>
      </li>   
    </ul>
  </div>  
</nav>

<div class="container-fluid">

     <div class='filter'>
          <p>Filter Lectures</p>
          <label><input type='radio' name='filter' value='watched'> Watched</label>
          <label><input type='radio' name='filter' value='not-watched'> Not Watched</label>
          <label><input type='radio' name='filter' checked value='all'> All</label>
      </div>

  <div id="accordion">
  <?php $j=0; foreach($subjects as $key=>$v){ ?>
    <div class="card">
      <div class="card-header">
        <a class="card-link text-dark" data-toggle="collapse" href="#id_<?=$j?>">
         	<?=$key?>
        </a>
      </div>
      <?php 
          foreach ($v as $le) {
               $str=$le->completed;
               $str2=explode(",", $str);
               if(in_array($le->id, $str2)){
                $le->completed=1;
               }else{
                $le->completed=0;
               }
          }
      ?>
      <div id="id_<?=$j?>" class="collapse <?=$j==0?'show':''?>" data-parent="#accordion">
        <div class="card-body">
         	<div class="row">
          <?php $i=0; foreach($v as $lecs){ ?>
             
             <?php 
              if($lecs->type=="video"){
                if($i==0 || isset($v[$i-1]->completed) && $v[$i-1]->completed==1){
                  $func="setVideo($lecs->id,'".base64_encode($lecs->title)."','$lecs->videoid',$lecs->completed)";
                  $disabled='';
                }
                else{
                  $func="";
                  $disabled='disabled';
                }
              ?>
         		<div class="col-sm-4 <?=$lecs->completed==1?'watched':'not-watched'?>">
         			<div class='chapter-item shadow-sm bg-primary <?=$disabled?>'  onclick="<?=$func?>" >
         				<i class='fas fa-file-video'></i> <?=$lecs->title?> 
         				<?=$lecs->completed==1?"<i class='fas fa-check'></i>":'' ?>
         			</div>
         		</div>
            <?php }?>

              <?php 
              if($lecs->type=="pdf"){
                if($i==0 || isset($v[$i-1]->completed) && $v[$i-1]->completed==1){
                  $func="setPDF($lecs->id,'".base64_encode($lecs->title)."','$lecs->videoid',$lecs->completed,$lecs->dw)";
                  $disabled='';
                }
                else{
                  $func="";
                  $disabled='disabled';
                }
              ?>
            <div class="col-sm-4  <?=$lecs->completed==1?'watched':'not-watched'?>">
              <div class='chapter-item shadow-sm bg-primary <?=$disabled?>'  onclick="<?=$func?>" >
                <i class='fas fa-file-pdf'></i> <?=$lecs->title?> 
                <?=$lecs->completed==1?"<i class='fas fa-check'></i>":'' ?>
              </div>
            </div>
            <?php }?>

            <?php $i++;}?>
         	</div>
        </div>
      </div>
    </div>
    <?php $j++; }?>
  </div>
</div>


 <div class="modal fade" id="videomodal">
    <div class="modal-dialog modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id='videotitle'></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style='padding:0'>
      	   		<div class="aspect-ratio">
      	   			<iframe id="videoiframe"  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          		</div>
      	   <div class='text-center p-2'>
      	   		<button id="videobtn" class='btn btn-primary btn-sm'>Mark as Finished</button>
           </div>
        </div>
      </div>
    </div>
  </div>

   <div class="modal fade" id="notesmodal">
    <div class="modal-dialog modal-xl ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="notestitle"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style='padding:0'>
      	   		<div class="notes-wrapper">
      	   			<iframe id="notesiframe" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          		</div>
      	   <div class='text-center p-2'>
      	   		<button id="notesbtn" class='btn btn-primary btn-sm'>Mark as Finished</button>
           </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="status">
    <div class="modal-dialog modal-xl ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="notestitle">Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
           <b>Status Changed!</b> Please Refresh Page so that changes can take effect. <br> <button style="margin-top:10px" onclick=window.location=location class="btn btn-primary btn-sm">Refresh</button>
        </div>
      </div>
    </div>
  </div>


</body>
<script>
var baseurl="<?=base_url()?>";

  function setVideo(id,title,vid,comp){
    $("#videomodal").modal();
    document.querySelector("#videotitle").innerHTML=atob(title);
    videoiframe.src="https://www.youtube.com/embed/"+vid;
    if(comp==1){
        videobtn.innerHTML="Mark as Un-Finished";
        videobtn.setAttribute("onclick","changeStatus("+id+","+comp+",'video')");
    }else{
        videobtn.innerHTML="Mark as Finished";
        videobtn.setAttribute("onclick","changeStatus("+id+","+comp+",'video')");
    }
  }

   function setPDF(id,title,path,comp,dw){
    $("#notesmodal").modal();
    document.querySelector("#notestitle").innerHTML=atob(title);
    notesiframe.src=baseurl+"pdf/web/viewer.html?file="+baseurl+path+"&download="+(dw==1?'true':'false');
    if(comp==1){
        notesbtn.innerHTML="Mark as Un-Finished";
        notesbtn.setAttribute("onclick","changeStatus("+id+","+comp+",'pdf')");
    }else{
        notesbtn.innerHTML="Mark as Finished";
        notesbtn.setAttribute("onclick","changeStatus("+id+","+comp+",'pdf')");
    }
  }

  function changeStatus(id,comp,caller){
      $.post({url:baseurl+'student/updatelecturestatus',data:{'id':id},success:function(data){
          if(comp==1){
            $("#notesbtn,#videobtn").text("Mark as Un-Finished");
          }
          else{
            $("#notesbtn,#videobtn").text("Mark as Finished");
          }
          if(caller=="video"){
            $("#videomodal").modal("hide");
          }
          else{
            $("#notesmodal").modal("hide");
          }
          $("#status").modal();
      }});
  }

  $("[name*=filter]").on("change",function(data){
      let cat= data.target.value;
      if(cat=='watched'){
        $(".watched").show();
        $(".not-watched").hide();
      }
      if(cat=='not-watched'){
        $(".not-watched").show();
        $(".watched").hide();
      }
      if(cat=='all'){
        $(".watched,.not-watched").show();
      }
      
  });

</script>
</html>