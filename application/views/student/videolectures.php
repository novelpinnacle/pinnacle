<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <title>Online Courses</title>
  <style>
  *{
    box-sizing: border-box;
  }
  body{
   padding:0;
   margin:0;
   font-family: Verdana; 
  }
  .body{
    padding-left: 360px;
  }
  nav{
    display: none;
  }
  .sidebar-video{
    width:350px;
    height:100%;
    overflow-y: scroll;
    position: fixed;
    top:0;
    left: 0;
    border-right: 1px solid #eee;
    background: #f0f0f0 ;
  }

  #backlink{
    padding: 10px 20px;
    background-color: #444;
    color:#f0f0f0;
    display: block;
    text-decoration: none;
  }

  .timeline{
    position: relative;
    padding-top: 10px;
  }
  .timeline:after{
    display: block;
    content: "";
    position: absolute;
    width: 5px;
    height: 100%;
    top:0;
    left: 20px;
    background: #aaa;
  }

.titles{

  margin-left: 50px;
  padding: 15px 10px;
  position: relative;
  margin-bottom: 10px;
  border-radius: 4px;
  width: calc(100% - 60px);
  font-size: 14px;
  cursor: pointer;
}

.titles:hover{
  background: #c5c5c5;
}
.titles.active{
  background: #c5c5c5;
}

.circle{
  position: absolute;
  left: -40px;
  width: 25px;
  top:8px;
  height: 25px;
  border-radius: 100%;
  border:2px solid #0a0;
  z-index: 2;
  background:#fff;
}
.circle .fa{
  position:relative;
  top:1px;
  left: 3px;
}

#header{
  list-style: none;
  margin:0;
  padding:0;
}
#header li{
 // padding-left: 10px;
}
#header li div.header-title{
  padding:15px;
  border-bottom:1px solid #ddd;
  cursor: pointer;
  background: #bbb;
}
.header-content{
  max-height: 0;
  overflow: hidden;
  transition: all .4s;
}

#header li:hover .header-content,#header li.active .header-content{
    max-height: none;

}


#content{
  padding:15px; 
}

#lecture-title{
  padding: 10px 20px;
  border-radius: 4px 0;
  background-color: #f0f0f0;
}


.video-container {
  position:relative;
  padding-bottom:56.25%;
  padding-top:30px;
  height:0;
  width: 100%;
  overflow:hidden;
}

.video-container #videoiframe{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}
#video{
  display: none;
  max-width:900px;
  margin-top: 20px;
}

#btn{
  display: inline-block;
  padding:8px 18px;
  font-size: 15px;
}
  
  .disabled{
    color:#ddd;
    cursor: not-allowed;
  }
  .disabled:hover{
    background:#f0f0f0; 
  }

@media screen and (max-width: 768px){
  .sidebar-video{
    width:300px;
    left: -300px;
    transition: all .3s;
    z-index: 1;
  }
  .show-sidebar{
    left: 0;
  }
  .body{
    padding-left: 0;
  }

 nav{
    display: block;
    background-color: #ddd;
    padding-top:4px;
    padding-bottom: 4px;
    overflow: hidden;
    padding-right: 15px;
  }

.menu-icon {
  display: inline-block;
  cursor: pointer;
  float: right;
}

.bar1, .bar2, .bar3 {
  width: 35px;
  height: 5px;
  background-color: #333;
  margin: 6px 0;
  transition: 0.4s;
}

.change .bar1 {
  -webkit-transform: rotate(-45deg) translate(-9px, 6px);
  transform: rotate(-45deg) translate(-9px, 6px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
  -webkit-transform: rotate(45deg) translate(-8px, -8px);
  transform: rotate(45deg) translate(-8px, -8px);
}

}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="body">

<nav>
    <div class="menu-icon" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
</nav>

<div class="sidebar-video">
   <a id="backlink" href="<?=base_url()?>student/">Back to Dashboard</a>
  <ul id='header'>
  <?php //var_dump($subjects); ?>
  <?php $id=100; foreach($subjects as $key=>$v){$id++;?>
    <li id="li<?=$id?>">
        <div class='header-title'><?=$key?></div>
        <div class="header-content">
          <div class="timeline">
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
            <?php $i=0; foreach($v as $lecs){?>
              <?php if($lecs->type=='video') {?>
                  <?php 
                    if($i==0 || isset($v[$i-1]->completed) && $v[$i-1]->completed==1){
                      $func="setVideo($lecs->id,this,'".base64_encode($lecs->title)."','$lecs->videoid',$lecs->completed)";
                      $disabled='';
                    }
                    else{
                      $func="";
                      $disabled='disabled';
                    }
                  ?>

                 <div class="titles <?=$disabled?>" onclick="<?=$func?>">
                 <div class='circle'>
                   
                   <?php
                     echo $lecs->completed?'<i class="fa fa-check"></i>':'';
                   ?>

                 </div> <?=$lecs->title?>  <i class='fa fa-file-video-o'></i></div>
              <?php }?>
              <?php if($lecs->type=='pdf') {?>

                   <?php 
                    if($i==0 || isset($v[$i-1]->completed) && $v[$i-1]->completed==1){
                      $func="setPdf($lecs->id,this,'".base64_encode($lecs->title)."','$lecs->videoid',$lecs->completed,$lecs->dw)";
                      $disabled='';
                    }
                    else{
                      $func="";
                      $disabled='disabled';
                    }
                  ?>

                 <div class="titles <?=$disabled?>" onclick="<?=$func?>">
                 <div class='circle'>
                   <?php
                    echo $lecs->completed?'<i class="fa fa-check"></i>':'';
                   ?>

                 </div> <?=$lecs->title?> <i class='fa fa-file-pdf-o'></i></div>
              <?php }?>
            <?php $i++; } ?>
          </div>
        </div>
    </li>
    <?php }?>
  </ul>

</div>

<div id="content">
    <div id="lecture-title"></div>
    <div id="video">
      <div class="video-container">
        <iframe id="videoiframe" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <iframe id="pdfiframe" src="" style="width:100%;height:70vh" frameborder="0" ></iframe>

    <div style="text-align:center;margin-top:50px;">
       <button class="w3-btn btn-default w3-border" id="btn"></button>
       <!-- <button class="w3-btn btn-default w3-border" id="db">Doubt?</button> -->
    </div>
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
function openModal(options){
  if(options.title!=undefined){$("#modalDialog .modal-title").text(options.title);}
  if(options.content!=undefined){$("#modalDialog .modal-body").html(options.content);}
  if(options.width!=undefined){$("#modalDialog .modal-dialog").css("width",options.width);}
  $("#modalDialog").modal({backdrop:'static'});
}</script>

<script>
var baseurl="<?=base_url()?>";
  function setVideo(id,ele,title,vid,comp){

      document.querySelector("#lecture-title").innerHTML=atob(title);
      video.style.display="block";
      videoiframe.src="https://www.youtube.com/embed/"+vid;
      pdfiframe.style.display="none";
      setActive(ele);

      if(comp==1){
        btn.innerHTML="Mark as Un-Finished";
        btn.setAttribute("onclick","changeStatus("+id+")");
      }else{
        btn.innerHTML="Mark as Finished";
        btn.setAttribute("onclick","changeStatus("+id+")");
      }

  }


  function setPdf(id,ele,title,path,comp,dw){
    document.querySelector("#lecture-title").innerHTML=atob(title);
    video.style.display="none";
    pdfiframe.style.display="block"; 
    pdfiframe.src=baseurl+"pdf/web/viewer.html?file="+baseurl+path+"&download="+(dw==1?'true':'false');
    setActive(ele);

     if(comp==1){
        btn.innerHTML="Mark as Un-Finished";
        btn.setAttribute("onclick","changeStatus("+id+")");
      }else{
        btn.innerHTML="Mark as Finished";
        btn.setAttribute("onclick","changeStatus("+id+")");
      }
  }

  function setActive(ele){
      var eles=document.querySelectorAll("#header li");
      for(let li of eles){
        li.classList.remove("active");
      }

     var eles=document.querySelectorAll(".titles");
      for(let el of eles){
        el.classList.remove("active");
      }

      ele.classList.add("active");
      ele.parentElement.parentElement.parentElement.classList.add("active");
      id=ele.parentElement.parentElement.parentElement.getAttribute("id");
      localStorage.setItem("active",id);
      myFunction(document.querySelector('.menu-icon'));
  }

  function changeStatus(id){
      $.post({url:baseurl+'student/updatelecturestatus',data:{'id':id},success:function(data){
          if($("#btn").text()=="Mark as Finished"){
            $("#btn").text("Mark as Un-Finished");
          }
          else{
            $("#btn").text("Mark as Finished");
          }
          openModal({title:'Status',content:'Status Changed! Please Refresh Page so that changes can visible in Navigation<br> <button style="margin-top:10px" onclick=window.location=location class="btn btn-default">Refresh</button>'});
      }});
  }

  function myFunction(x) {
    x.classList.toggle("change");
    document.querySelector(".sidebar-video").classList.toggle("show-sidebar");
  }

  if(localStorage.getItem("active")!=undefined){
    document.querySelector("#"+localStorage.getItem("active")).classList.add("active");
  }

</script>
</body>
</html>