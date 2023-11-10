<style>
div#calendar{
  margin:0px auto;
  padding:0px;
  width: 602px;
  font-family:Helvetica, "Times New Roman", Times, serif;
}
 
div#calendar div.box{
    border-radius:4px 4px 0 0;
    position:relative;
    top:0px;
    left:0px;
    width:100%;
    height:40px;
    background-color: var(--main-bg-color1);      
}
 
div#calendar div.header{
    line-height:40px;  
    vertical-align:middle;
    position:absolute;
    left:11px;
    top:0px;
    width:582px;
    height:40px;   
    text-align:center;
}
 
div#calendar div.header a.prev,div#calendar div.header a.next{ 
    position:absolute;
    top:0px;   
    height: 17px;
    display:block;
    cursor:pointer;
    text-decoration:none;
    color:#FFF;
}
 
div#calendar div.header span.title{
    color:#FFF;
    font-size:18px;
}
 
 
div#calendar div.header a.prev{
    left:0px;
}
 
div#calendar div.header a.next{
    right:0px;
}
 
/*******************************Calendar Content Cells*********************************/
div#calendar div.box-content{
    border:1px solid #ddd;
    border-top:none;
    border-radius: 0 0 4px 4px;
}
 
 
div#calendar ul.label{
    float:left;
    margin: 0px;
    padding: 0px;
    margin-top:5px;
    margin-left: 5px;
}
 
div#calendar ul.label li{
    margin:0px;
    padding:0px;
    margin-right:5px;  
    float:left;
    list-style-type:none;
    width:80px;
    height:40px;
    line-height:40px;
    vertical-align:middle;
    text-align:center;
    color:#000;
    font-size: 15px;
    background-color: transparent;
}
 
 
div#calendar ul.dates{
    float:left;
    margin: 0px;
    padding:0px;
    overflow: hidden;
    background-color: #ddd;
}
 
/** overall width = width+padding-right**/

div#calendar ul.dates li{
    margin:0px;
    padding:0 4px;
    margin:2.5px;
    line-height:1.4em;
    vertical-align:middle;
    float:left;
    list-style-type:none;
    width:80px;
    height:80px;
    padding-top: 4px;
    font-size:15px;
    background-color: #fff;
    color:#000;
    text-align:center; 
}
div#calendar ul.dates li.start{
    margin-left: 4px;
}
div#calendar ul.dates li.end{
    margin-right: 4px;
}

.cb{
    font-size: 10px;
    line-height:17px;
    background-color: #3185eb;
    color:#fff;
    text-align: left;
    padding: 0 4px;
    border-radius: 3px;
}
.cb .line{
    height: 1px;
    background-color: #fff;
}

:focus{
    outline:none;
}
 
div.clear{
    clear:both;
}
</style>