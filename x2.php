
	
<!DOCTYPE html>
<html>
 <head>
     <script src="js/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script> 

  
    
<script src="plugins/ng-file-upload-bower-12.2.13/ng-file-upload-shim.min.js"></script>
<script src="plugins/ng-file-upload-bower-12.2.13/ng-file-upload.min.js"></script>

</head>

<style>
    /*
.thumb {
    width: 24px;
    height: 24px;
    float: none;
    position: relative;
    top: 7px;
}

form .progress {
    line-height: 15px;
}

.progress {
    display: inline-block;
    width: 100px;
    border: 3px groove #CCC;
}

.progress div {
    font-size: smaller;
    background: orange;
    width: 0;
}
*/
</style>



<body ng-app="fileUpload" ng-controller="MyCtrl">
  <h4>Upload on file select</h4>
  <button type="file" ngf-select="uploadFiles($file, $invalidFiles)"
          accept="image/*" ngf-max-height="1000" ngf-max-size="1MB">
      Select File</button>
  <br><br>
  File:
  <div style="font:smaller">{{f.name}} {{errFile.name}} {{errFile.$error}} {{errFile.$errorParam}}
      <span class="progress" ng-show="f.progress >= 0">
          <div style="width:{{f.progress}}%"  
               ng-bind="f.progress + '%'"></div>
      </span>
  </div>
  {{errorMsg}}

  

</body>
</html>
 


<script>//inject angular file upload directives and services.
var app = angular.module('fileUpload', ['ngFileUpload']);

app.controller('MyCtrl', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {
    $scope.uploadFiles = function(file, errFiles) {
        $scope.f = file;
        $scope.errFile = errFiles && errFiles[0];
        if (file) {
            file.upload = Upload.upload({
                url: 'x2upload.php',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }   
    }
}]);
</script>