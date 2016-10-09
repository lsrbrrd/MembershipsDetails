(function(angular, $, _) {

  angular.module('task2').config(function($routeProvider) {
      $routeProvider.when('/Task', {
        controller: 'Task2controllerTask',
        templateUrl: '~/task2/controllerTask.html',
        resolve: { }
      });
    }
  );

  angular.module('task2').controller('Task2controllerTask', function($scope, crmApi, crmStatus, crmUiHelp, $filter) {
    var ts = $scope.ts = CRM.ts('task2');
    var hs = $scope.hs = crmUiHelp({file: 'CRM/task2/controllerTask'}); 
$scope.cantidad = 10;
    $scope.membership = [];
	$scope.searchMemeberships =  function()
	{
		CRM.api3('Membership', 'get', {
		  "sequential": 1,
		  "return": ["id","contact_id.display_name","membership_type_id.name","start_date","end_date"]
		}).done(function(result) {
		console.log(result.values);
			var error = ''
			if (result.is_error){
				error = 'Error, I proceed to set a custom list of memberships: ' + result.error_message;
			} else {
				if (result.count === 0){
					error = 'No memberships were found in the data base, I proceed to set a custom list of memberships.';
				} else 
					for (var i=0;i<result.values.length; i++ )
						$scope.membership.push({id: result.values[i].id, name: result.values[i]['contact_id.display_name'], type: result.values[i]['membership_type_id.name'], start: $filter('date')(new Date(result.values[i].start_date),'dd/MM/yyyy'), end: $filter('date')(new Date(result.values[i].end_date),'dd/MM/yyyy')});
			}
			if (error !== ''){
				alert(error);	
				$scope.membership.push({id: 1, name: 'ONG1', type: 'Student1', start:'01/09/2016', end: '01/10/2016'});
				$scope.membership.push({id: 2, name: 'ONG2', type: 'Student2', start: '01/10/2016', end: '01/10/2017'});
				$scope.membership.push({id: 3, name: 'ONG3', type: 'Student3', start: '01/10/2016', end: '01/12/2016'});
			}
			$scope.$apply();
		});
	}
	$scope.searchMemeberships();
						
	$scope.membershipFiltered = $scope.membership;
	
	$scope.range = {start: $filter('date')(new Date(),'dd/MM/yyyy'), end: $filter('date')(new Date(),'dd/MM/yyyy')};
	
	$scope.filter = function()
	{
		$scope.membershipFiltered = [];
		for (var i = 0; i < $scope.membership.length; i++){
			if ((new Date($scope.membership[i].start.substring(6,10), $scope.membership[i].start.substring(3, 5), $scope.membership[i].start.substring(0,2))
				>= new Date($scope.range.start.substring(6,10), $scope.range.start.substring(3, 5), $scope.range.start.substring(0,2)))
				&& (new Date($scope.membership[i].end.substring(6,10), $scope.membership[i].end.substring(3, 5), $scope.membership[i].end.substring(0,2))
				<= new Date($scope.range.end.substring(6,10), $scope.range.end.substring(3, 5), $scope.range.end.substring(0,2))))
					$scope.membershipFiltered.push($scope.membership[i]);
		}
	}
	
  });

})(angular, CRM.$, CRM._);
