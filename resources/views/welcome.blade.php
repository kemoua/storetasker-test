<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div style="float: left;">
                <!-- Display all elements in the database -->
                <table>
                <th>Name</th><th>Price</th>
                <?php foreach ($products as $product) {?>
                    <tr><td><?php echo $product->name;?></td>
                    <td><?php echo $product->price;?></td></tr>
                <?php }
                ?>

                <!-- Insert Products In the DB. Price is set to 0. -->
                </table>
                <form method="POST" action="/">
                    <input type="text" name="newProduct" placeholder="Enter new product name">
                    <input type="submit" name="submit" value="Insert">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
                </div>


                <!-- Search for elements -->
                <div ng-app="myApp" ng-controller="productsCtrl" style="float: right;">
                    Search Product:<br><input type="text" ng-model="searchterm" ng-change="search(searchterm)" placeholder="Search..."></p>
                    <!-- Displays the results -->
                    <table>
                    <tr><th>Name</th><th>Price</th></tr>
                      <tr ng-repeat="x in products"> <!-- A more basic way would use: ng-repeat="x in products | filter:searchterm" -->
                        <td>@{{ x.name }}</td>
                        <td>@{{ x.price }}</td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Controller -->
        <script>
            var app = angular.module('myApp', []);
            app.controller('productsCtrl', function($scope, $http) {

                $scope.search = function(s) {
                $http.get('/search/'+s)
                .then(function (response) {$scope.products= response.data;});
                  };

            });
            /* Controller for the simple solution
            var app = angular.module('myApp', []);
            app.controller('productsCtrl', function($scope, $http) {
                 $http.get('/search/')
                 .then(function (response) {$scope.products= response.data;});
             });
            */
        </script>
    </body>
</html>
