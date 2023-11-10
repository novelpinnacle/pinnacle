<style>
#links-sidebar{
	box-shadow: 0 0 10px rgba(0,0,0,0.24);
	background: #fff;
	padding:10px 5px;
	position: relative;
}
#links-sidebar a{
	display: block;
	padding:5px 10px;
	margin-bottom: 4px;
	background: #f3f3f3;
	color: var(--main-bg-color2);
}
.section{
	padding-top: 0;
}
#center-line{
	height:10px;
	position: relative;
	top:-10px;
	width: 80%;
	margin: 0 auto;
	background: #f80;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

<div ng-app="myApp">
<div class="container">
	<div class="row" style="margin-top:100px">
		<div class="col-sm-9">
			<div ng-view></div>
		</div>
		<div class="col-sm-3">
			<div id="links-sidebar">
				<div id='center-line'></div>
				<a href="<?=base_url()?>home/ourcourses#!/8th">8th Class</a>
				<a href="<?=base_url()?>home/ourcourses#!/9th">9th Class</a>
				<a href="<?=base_url()?>home/ourcourses#!/10th">10th Class</a>
				<a href="<?=base_url()?>home/ourcourses#!/11th">11th Class</a>
				<a href="<?=base_url()?>home/ourcourses#!/12th">12th Class</a>
			</div>
		</div>
	</div>
</div>
</div>





<script>
var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "<?=base_url()?>home/courses/8th"
    })
    .when("/8th", {
        templateUrl : "<?=base_url()?>home/courses/8th"
    })
    .when("/9th", {
        templateUrl : "<?=base_url()?>home/courses/9th"
    })
    .when("/10th", {
        templateUrl : "<?=base_url()?>home/courses/10th"
    })
    .when("/11th", {
        templateUrl : "<?=base_url()?>home/courses/11th"
    })
    .when("/12th", {
        templateUrl : "<?=base_url()?>home/courses/12th"
    });
});
</script>