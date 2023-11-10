<style>
.slider-text {
			position: absolute;
			top:50px;
			left:120px;	
			right:120px;
			width: 60%;			
		}
		.carousel-inner > .item > img {
			max-width: 100%;
			height:auto;
			width: 100%;
			max-height:calc(100vh - 101px);
		}
		.slider-text .w3-btn{font-size: 18px;}
		.slider-text h1{
			text-transform: capitalize;
			color:#fff;
			line-height: 70px;
			font-size: 55px;
			font-weight: 700;
		}
		.slider-text h1>span{
			color:var(--main-bg-color2);
		}
		.slider-text p{
			font-size: 16px;
			color:#ccc;
		}
		.slider-text .button{
			margin-top: 50px;
		}
		.slider-right{
			text-align: right;
			left:initial;
		}
		.slider-center{
			text-align: center;
			left:calc(23%);
		}
		.slider-right p{
			padding:0 0 0 100px;
		}
		.carousel-control{
			width:50px;
			height:50px;
			top:calc(50% - 25px);
			border-radius: 100%;
			background:rgba(0,0,0,0.2);
		}
		.carousel-control:hover{
			background: var(--main-bg-color1);
		}
		.carousel-control.left{
			left:20px;
		}
		.carousel-control.right{
			right:20px;
		}

		.carousel-control .glyphicon-chevron-left{
			color:#fff;
			top:calc(50% - 5px);
			margin-left: -15px;
		}
		.carousel-control .glyphicon-chevron-right{
			color:#fff;
			top:calc(50% - 5px);
			margin-right: -15px;
		}
</style>