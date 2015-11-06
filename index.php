<!DOCTYPE HTML>
<html ng-app="myQuiz">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Philadelphia Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/quiz.css">
	</head>
	<body>
		<div id="myQuiz" ng-controller="QuizController">
			<div class="progress">
				<div class="
				{{ ($index === activeQuestion) ? 'on' : 'off' }}
				{{ (myQuestion.questionState === 'answered') ? 'answered' : 'unanswered' }}
				{{ (myQuestion.correctness === 'correct') ? 'correct' : 'incorrect' }}
				" ng-repeat="myQuestion in myQuestions"></div>
			</div>
			<div class="intro {{ (activeQuestion > -1) ? 'inactive' : 'active' }}">
				<h2>Welcome</h2>
				<p>Click begin to test your knowledge of Philadelphia.</p>
				<p class="btn" ng-click="activeQuestion = 0">Begin</p>
			</div>
			<div class="question 
			{{ $index === activeQuestion ? 'active' : 'inactive' }}
			{{ myQuestion.questionState === 'answered' ? 'answered' : 'unanswered' }}
			" ng-repeat="myQuestion in myQuestions">
				<p class="txt">{{myQuestion.question}}</p>
				<p class="ans" 
				ng-class="{ 
				image:Answer.image,
				selected:isSelected($parent.$index, $index), 
				correct:isCorrect($parent.$index, $index) }"
				ng-style="{ 'background-image':'url({{Answer.image}})' }"
				ng-click="selectAnswer($parent.$index, $index)"
				ng-repeat="Answer in myQuestions[$index].answers">{{Answer.text}}</p>
				<div class="feedback">
					<p ng-show="myQuestion.correctness === 'correct'">You are <strong>correct</strong>. </p>
					<p ng-show="myQuestion.correctness === 'incorrect'">Oops! That is not correct. </p>
					<p>{{myQuestion.feedback}}</p>
					<p ng-click="selectContinue()" class="btn">Continue</p>
				</div>
			</div>
			<div class="results {{ (totalQuestions === activeQuestion) ? 'active' : 'inactive' }}">
				<h3>Results</h3>
				<p>You scored {{percentage}}% by correctly answering {{score}} of the total {{totalQuestions}} questions.</p>
				<p>Use the links below to challenge your friends.</p>
				<div class="share" ng-bind-html="createShareLinks(percentage)">
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/angular.min.js"></script>
		<script type="text/javascript" src="js/quiz.js"></script>
	</body>
</html>



















