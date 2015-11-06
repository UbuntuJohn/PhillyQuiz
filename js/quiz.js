(function(){

	var app = angular.module('myQuiz', []);

	app.controller('QuizController', ['$scope','$http','$sce', function($scope, $http, $sce) {

		$scope.score = 0;
		$scope.activeQuestion = -1;
		$scope.activeQuestionAnswered = 0;
		$scope.percentage = 0;

		//quizData now equals to quiz_data.json
		$http.get('quiz_data.json').then(function(quizData) {
			//assigning variables to files
			$scope.myQuestions = quizData.data;
			$scope.totalQuestions = $scope.myQuestions.length;
		});

		$scope.selectAnswer = function(qIndex, aIndex) {
			var questionState = $scope.myQuestions[qIndex].questionState;

			if(questionState != 'answered') {
				$scope.myQuestions[qIndex].selectedAnswer = aIndex;
				var correctAnswer = $scope.myQuestions[qIndex].correct;
				$scope.myQuestions[qIndex].correctAnswer = correctAnswer;
				if(aIndex === correctAnswer) {
					$scope.myQuestions[qIndex].correctness = 'correct';
					$scope.score += 1;
				} else {
					$scope.myQuestions[qIndex].correctness = 'incorrect';
				}

				$scope.myQuestions[qIndex].questionState = 'answered';
			}

			$scope.percentage = (($scope.score / $scope.totalQuestions) * 100).toFixed(1);
		}

		$scope.isSelected = function(qIndex, aIndex) {
			return $scope.myQuestions[qIndex].selectedAnswer === aIndex;

		}

		$scope.isCorrect = function(qIndex, aIndex) {
			return $scope.myQuestions[qIndex].correctAnswer === aIndex;

		}

		$scope.selectContinue = function() {
			return $scope.activeQuestion += 1;
		}

		$scope.createShareLinks = function(percentage) {
			var url = 'http://google.com';
			var emailLink = '<a class="btn email" href="mailto:?subject=Try to beat my quiz score!&amp;body=I scored a '+percentage+'% on this quiz about Saturn. Try to beat my score at '+url+'">Email a friend</a>';
			var twitterLink = '<a class="btn twitter" target="_blank" href="https://twitter.com/intent/tweet?text=I scored a '+percentage+'% on this quiz about Saturn.">Tweet your score</a>';
			var newMarketup = emailLink + twitterLink;

			return $sce.trustAsHtml(newMarketup);
		}

	}]);

})();




































