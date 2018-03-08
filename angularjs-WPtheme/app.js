var appPartials = appPartials.proot;
var domainserver = wpApiSettings.root,
    apiurl = domainserver + 'wp/v2/',
    jspath = appScripts.jsroot + '/',
    widgetapi = domainserver + 'wp-rest-api-sidebars/v2/sidebars/';


var idsapps = angular.module('idsapps', ['ngRoute', 'ngSanitize', 'ngAnimate', 'duParallax']);

idsapps.config(['$routeProvider', '$locationProvider', '$compileProvider',



    function($routeProvider, $locationProvider, $compileProvider) {




        $routeProvider
            .when('/', {
                templateUrl: appPartials + '/home.html',
                controller: 'mainController',
                controllerAs: 'home',
                animate: 'ng-animate'
            })
            .when('/:slug/', {
                templateUrl: appPartials + '/content/content.php',
                controller: 'ContentCtrl',
                controllerAs: 'content',
                animate: 'ng-animate'
            })
            .when('/posts/:slug/', {
                templateUrl: appPartials + '/posts/post.html',
                controller: 'postCtrl',
                controllerAs: 'posts',
                animate: 'ng-animate'
            })
            .when('/members/all', {
                templateUrl: appPartials + '/members/members.html',
                controller: 'membersListCtrl',
                controllerAs: 'membersList',
                animate: 'ng-animate'
            })
            .when('/members/:slug/', {
                templateUrl: appPartials + '/members/member.html',
                controller: 'membersCtrl',
                controllerAs: 'members',
                animate: 'ng-animate'
            })
            .when('/speakers/all', {
                templateUrl: appPartials + '/speakers/speakers.html',
                controller: 'speakersListCtrl',
                controllerAs: 'speakersList',
                animate: 'ng-animate'
            })
            .when('/speakers/:slug/', {
                templateUrl: appPartials + '/speakers/speaker.html',
                controller: 'speakersCtrl',
                controllerAs: 'speakers',
                animate: 'ng-animate'
            })
            .when('/events/all', {
                templateUrl: appPartials + '/events/events.html',
                controller: 'eventsListCtrl',
                controllerAs: 'eventsList',
                animate: 'ng-animate'
            })
            .when('/events/:slug/', {
                templateUrl: appPartials + '/events/event.html',
                controller: 'eventsCtrl',
                controllerAs: 'events',
                animate: 'ng-animate'
            })
            .when('/search/all/', {
                templateUrl: appPartials + '/search/search.html',
                controller: 'searchCtrl',
                controllerAs: 'searchs',
                animate: 'ng-animate'
            })
            .otherwise({ redirectTo: '/' });

        $locationProvider.html5Mode(true);
        idsapps.compileProvider = $compileProvider;

    }
])


/* Toolbar Directive */

idsapps.directive('toolbarTip', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            $(element).toolbar(scope.$eval(attrs.toolbarTip));
        }
    };
});

/* Side widget Area */

idsapps.directive('slideWidget', function() {
    return {
        restrict: 'E',
        template: '<header id="{{$scope.id}}" class="ids-branding-slider" ng-bind-html="htmlSafe(widget.rendered)" ></header>',
        controller: ['$scope', '$http', '$sce', function($scope, $http, $sce) {

            $http({
                method: "GET",
                url: widgetapi + 'home_slider'
            }).then(function success(response) {
                    var widgetData = response.data;
                    $scope.widget = widgetData;

                    $scope.htmlSafe = function(data) {

                        return $sce.trustAsHtml(data);
                    }

                },
                function myError(response) {
                    $scope.myWelcome = response.statusText;
                })

        }],
    }

});


/* Categories List Menu Directive */

idsapps.directive('postList', function($compile) {
    return {
        restrict: 'E',
        transclude: true,
        template: '<article  ng-repeat="postlst in PostList"><h2><a class="green-sea-color" ng-href="{{postlst.permalink}}">{{postlst.title}}</a></h2><div class="light-grey-color" ng-bind-html="htmlSafe(postlst.excerpt)"></div></article>',
        controller: ['$scope', '$http', '$routeParams', '$sce', function($scope, $http, $routeParams, $sce) {
            $http({
                method: "GET",
                url: apiurl + 'posts/' + $routeParams.slug
            }).then(function success(response) {


                    var PostListData = response.data;
                    if ($routeParams.slug == response.data[0].cateslug) {


                        $scope.PostList = PostListData;

                        $scope.htmlSafe = function(data) {

                            return $sce.trustAsHtml(data);
                        }

                    } else { console.log("Under following category/Page no post, Please add posts under category or page."); }

                },
                function myError(response) {
                    $scope.myWelcome = response.statusText;
                })

        }],

    }

});





idsapps.controller('mainController', ['$scope', '$http', '$routeParams', '$sce', function($scope, $http, $routeParams, $sce) {


    $http({
        method: "GET",
        url: apiurl + 'pages?slug=home'
    }).then(function mySucces(response) {

            var homepage = response.data;
            $scope.page = homepage[0];

            $scope.htmlSafe = function(data) {

                return $sce.trustAsHtml(data);
            }


        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });


}]);




idsapps.controller('ContentCtrl', ['$scope', '$http', '$routeParams', '$sce', function($scope, $http, $routeParams, $sce) {

    $http({
        method: "GET",
        url: apiurl + 'pages?slug=' + $routeParams.slug
    }).then(function mySucces(response) {

            var otherpage = response.data;
            $scope.page = otherpage[0];

            $scope.htmlSafe = function(data) {

                return $sce.trustAsHtml(data);
            }



        },

        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);




idsapps.controller('postCtrl', ['$scope', '$http', '$routeParams', '$sce', function($scope, $http, $routeParams, $sce) {

    $http({
        method: "GET",
        url: apiurl + "posts?slug=" + $routeParams.slug
    }).then(function mySucces(response) {

            var datapost = response.data;
            $scope.post = datapost[0];

            $scope.htmlSafe = function(data) {

                return $sce.trustAsHtml(data);
            }

        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });


}]);


idsapps.controller('membersCtrl', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $http({
        method: "GET",
        url: apiurl + "members?slug=" + $routeParams.slug
    }).then(function mySucces(response) {

            var datamember = response.data;
            $scope.member = datamember[0];
            $scope.member.designation = datamember[0].ids_member_customfields.ids_member_designation;
            $scope.member.email = datamember[0].ids_member_customfields.ids_member_email;
            $scope.member.userImageUrl = datamember[0].featured_image;



        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);




idsapps.controller('membersListCtrl', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $http({
        method: "GET",
        url: apiurl + "members"
    }).then(function mySucces(response) {

            var datamembers = response.data;
            $scope.members = datamembers;
            
        

            $scope.this = function(member) {
                $scope.designation.value = member;
            }

        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);


idsapps.controller('speakersCtrl', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $http({
        method: "GET",
        url: apiurl + "speakers?slug=" + $routeParams.slug
    }).then(function mySucces(response) {

            var dataspeaker = response.data;
            $scope.speaker = dataspeaker[0];
            $scope.speaker.location = dataspeaker[0].ids_speaker_customfields.ids_speaker_location;
            $scope.speaker.email = dataspeaker[0].ids_speaker_customfields.ids_speaker_email;
            $scope.speaker.userImageUrl = dataspeaker[0].featured_image;
            $scope.speaker.rawtopics = dataspeaker[0].ids_speaker_customfields.topics_data;

            var myTopics = [];
            angular.copy($scope.speaker.rawtopics, myTopics);

            mt = myTopics.toString();
            var ns = mt.replace(/;/ig, ',');
            var rb = ns.replace(/s:[0-9]/g, '');
            var ar = rb.replace(/[^a-zA-Z]:[0-9]/g, '');
            var spt = ar.replace(/a:[0-9]/g, '');
            var ri = spt.replace(/i:[0-9]/g, '');
            var sl = ri.replace(/"title"/g, '');
            var cl = sl.replace(/:/g, '');
            var cb = cl.replace(/[{}]/g, '');
            var cc = cb.replace(/,/g, '  ');
            var nc = cc.replace(/[0-9]/g, '');

            $scope.speaker.topics = nc;

        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);



idsapps.controller('eventsListCtrl', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $http({
        method: "GET",
        url: apiurl + "events"
    }).then(function mySucces(response) {

            var dataevents = response.data;
            $scope.events = dataevents;

        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);



idsapps.controller('eventsCtrl', ['$scope', '$http', '$routeParams', '$sce', function($scope, $http, $routeParams, $sce) {

    $http({
        method: "GET",
        url: apiurl + "events?slug=" + $routeParams.slug
    }).then(function mySucces(response) {

            var dataevent = response.data;
            $scope.event = dataevent[0];
            $scope.event.date = dataevent[0].ids_event_cfields.ids_event_date;
            $scope.event.userImageUrl = dataevent[0].featured_image;


            $scope.htmlSafe = function(data) {

                return $sce.trustAsHtml(data);
            }

        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);



idsapps.controller('speakersListCtrl', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {

    $http({
        method: "GET",
        url: apiurl + "speakers"
    }).then(function mySucces(response) {

            var dataspeakers = response.data;
            $scope.speakers = dataspeakers;

        },
        function myError(response) {
            $scope.myWelcome = response.statusText;
        });

}]);




idsapps.controller('parallaxCtrl', function($scope, parallaxHelper) {
    $scope.background = parallaxHelper.createAnimator(-0.5, 250, -50);
});






idsapps.directive('autoActive', ['$location', '$http', '$routeParams', function($location, $http, $routeParams) {
    return {
        restrict: 'A',
        scope: false,
        link: function(scope, element) {
            function setActive() {
                var path = $location.path();
                if (path) {
                    angular.forEach(element.find('li'), function(li) {
                        var anchor = li.querySelector('a');

                        if (anchor.href == $location.absUrl()) {

                            angular.element(anchor).addClass('active');

                            if (angular.element(anchor).parent().parent().hasClass('sub-menu')) {
                                angular.element(anchor).parent().parent().parent().find('>a:first-child').addClass('active');

                            }
                        } else {
                            angular.element(anchor).removeClass('active');

                        }
                    });
                }
            }

            setActive();

            scope.$on('$locationChangeSuccess', setActive);
        }
    }
}]);

idsapps.controller('searchCtrl', ['$scope', '$http', function($scope, $http) {


    $http({
        method: 'GET',
        url: apiurl + 'allsearch'
    }).then(function success(response) {

        var srchData = response.data;

        $scope.search = {};
        $scope.search = function() {
            if ($scope.searchtxt.length > 0) {
                $scope.posts = srchData;
            } else {
                $scope.posts = []
            }
        }

    }).then(function myError(response) {

        $scope.myWelcome = response;

    });

}])

idsapps.directive('searchForm', function() {
    return {
        restrict: 'EA',
        template: '<div class="srch-box" ><input type="text" name="s" placeholder="Type your Keywords.." ng-model="searchtxt" ng-change="search()"><span class="fa srch-lbl fa-search" ></span></div>',
        controller: 'searchCtrl',
        controllerAs: 'searchs'
    };
});

idsapps.filter('trusted', function($sce) {
    return function(url) {
        return $sce.trustAsResourceUrl(url);
    };
})


/*AngularJS End App */



