export function configRouter(router) {

	// Set up routing and match routes to components
	router.map({
	  '/': {
	  	name: 'home',
	    component: require('./pages/Home.vue'),
	    auth: true
	  },
	  'followers': {
	  	name: 'followers',
	    component: require('./pages/Followers.vue'),
	    auth: true
	  },
	  'folowing': {
	  	name: 'folowing',
	    component: require('./pages/Following.vue'),
	    auth: true
	  },
	  'favorites': {
	  	name: 'favorites',
	    component: require('./pages/Favorites.vue'),
	    auth: true
	  },
	  'posts/:uid': {
	  	name: 'post',
	  	component: require('./components/posts/Post.vue'),
	    auth: true
	  },
	  'users/:username': {
	  	name: 'user',
	  	component: require('./components/users/User.vue'),
	    auth: true
	  },
	  'login': {
	  	name: 'login',
	  	component: require('./pages/Auth.vue'),
	  	guest: true
	  },
	  'logout': {
	  	name: 'logout',
	  	component: require('./pages/Auth.vue'),
	  	auth: true
	  }
	});

	router.beforeEach(function (transition) {

		const token = localStorage.getItem('api_token');

	  if (transition.to.auth) {
	  	if(!token || token === null) {
	    	transition.redirect('/login');
	  	}
	  }

	  if(transition.to.guest) {
	  	if(token) transition.redirect('/');
	  }

	  transition.next();
	});

	// Redirect to the home route if any routes are unmatched
	router.redirect({
	  '*': '/',
	  '/auth': '/login'
	});

}
