<!DOCTYPE html>
<html lang="en">
<head>
	<title>ToyRobot simulation</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container" ng-app="myApp" ng-controller="toyRobotController">

		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-8">

				<h1>Welcome to ToyRobot simulation</h1>
				
				<div class="form-group">
					<label for="usr">Command:</label>
					<div class="row">
						<div class="col-md-9">
							<input type="text" class="form-control" ng-model="command_box">
						</div>
						<div class="col-md-3">

							<button type="button" class="btn btn-primary" ng-click="pushTextCont()">Execute</button>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="usr">Terminal:</label>
					<div class="row">
						<div class="col-md-9">
							<textarea class="form-control" rows="20" readonly>@{{scripts}}</textarea>
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-warning" ng-click="deleteSessionCont()">Reset simulation</button>
							<br><br> <a href="{{ url('/txtfiles/demo.txt')}}" target="_blank" class="btn btn-info">Demo txt file</a>
						</div>
					</div>
				</div>

				
				@if ($message = Session::get('failure'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<form action="{{ url('toyrobotfileupload') }}" enctype="multipart/form-data" method="POST">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-9">
							<input type="file" name="txtfile" />
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-success">Upload</button>
						</div>
					</div>
				</form>
			</div>

			<div class="col-md-2">
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script type="text/javascript">
		var app = angular.module("myApp",[]);
	</script>
	<script type="text/javascript">
		app.controller("toyRobotController", function($scope, toyRobotService, $timeout){

			$scope.scripts = '';

			
			@if(isset($file_contents))
			
			var file_contents_arr = new Array();			
			@foreach ($file_contents as $content)
			file_contents_arr[{{$loop->index}}] = "{{$content}}" ;		
			@endforeach
			
			var i;
			
			for (i = 0; i < file_contents_arr.length; i++) {
				(function(i){
					$timeout(function() {
						toyRobotService.pushText(file_contents_arr[i])
						.then(function(response){ 
							if(response.data == 0)
							{
								$scope.scripts = $scope.scripts + file_contents_arr[i] + '\n';
							}
							else
							{
								$scope.scripts = $scope.scripts + file_contents_arr[i] + '\n' +response.data + '\n';
							}
						});
					}, i * 1000);
				})(i);	
			}

			@endif	

			$scope.pushTextCont = function() {
				var flag = 1;
				if(!$scope.command_box)
				{
					flag = 0;
					$scope.scripts = $scope.scripts + 'Command line is empty' + '\n';
				}

				if(flag)
				{
					toyRobotService.pushText($scope.command_box)
					.then(function(response){ 
						if(response.data == 0)
							$scope.scripts = $scope.scripts + $scope.command_box + '\n';
						else
							$scope.scripts = $scope.scripts + $scope.command_box + '\n' +response.data + '\n';
						$scope.command_box = "";
					});
				}

			};

			$scope.deleteSessionCont = function() {
				toyRobotService.deleteSession()
				.then(function(response){ 
					$scope.scripts = "";
					$scope.command_box = "";
				});
			};
		});
	</script>
	<script type="text/javascript">
		app.service('toyRobotService', ['$http', function($http){
			
			var headers = {
				'Access-Control-Allow-Origin' : '*',
				'Access-Control-Allow-Methods' : 'GET, POST, PUT, DELETE, OPTIONS',
				'Conent-Type' : 'application/json',
				'Accept' : 'application/json'
			};

			this.pushText = function(command_text){
				return $http({
					method: "POST",
					headers: headers,
					url: "/api/toyrobot",
					params:{'command_text': command_text}});
			};
			
			
			this.deleteSession = function(){
				return $http({
					method: "POST",
					headers: headers,
					url: "/api/toyrobotsession"
				});
			};

		}]); 

	</script>
</body>
</html>