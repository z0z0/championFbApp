var uid; 
 window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '430747907025436',                        // App ID from the app dashboard
      channelUrl : 'http://nekretnineapartman.rs/fbz/like_us.php', // Channel file for x-domain comms
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here
	
	FB.Canvas.setSize({ height: 1000 });
	FB.getLoginStatus(function(response) {
		  if (response.status === 'connected') {
			// the user is logged in and has authenticated your
			// app, and response.authResponse supplies
			// the user's ID, a valid access token, a signed
			// request, and the time the access token 
			// and signed request each expire
			uid = response.authResponse.userID;
			verifyContest();
			
		  } else if (response.status === 'not_authorized') {
				FB.login(function(response) {
		   if (response.authResponse) {
			 console.log('Welcome!  Fetching your information.... ');
			 FB.api('/me', function(response) {
			  uid = response.authResponse.userID;
			 });
		   } else {
			console.log('User cancelled login or did not fully authorize.');
			}		
				});
		} else {
    // the user isn't logged in to Facebook.
		}
	});
  };

  // Load the SDK asynchronously
  (function(){
     // If we've already installed the SDK, we're done
     if (document.getElementById('facebook-jssdk')) {return;}

     // Get the first script element, which we'll use to find the parent node
     var firstScriptElement = document.getElementsByTagName('script')[0];

     // Create a new script element and set its id
     var facebookJS = document.createElement('script'); 
     facebookJS.id = 'facebook-jssdk';

     // Set the new script's source to the source of the Facebook JS SDK
     facebookJS.src = '//connect.facebook.net/en_US/all.js';

     // Insert the Facebook JS SDK into the DOM
     firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
   }());