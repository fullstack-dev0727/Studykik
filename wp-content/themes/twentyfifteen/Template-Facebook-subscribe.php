<?php
/*
 * Template Name: Facebook App Subscribe Page
 */
?>


<h3>Subscribe the app to the Pages</h3>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1754948814742578',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function subscribeApp(page_id, page_access_token) {
    console.log('Subscribing page to app! ' + page_id);
    FB.api(
      '/' + page_id + '/subscribed_apps', 
      'post',
      {access_token: page_access_token},
      function(response) {
      console.log('Successfully subscribed page', response);
      console.log(page_id);
      var ss = document.getElementsByClassName(page_id);
      console.log(ss);
      ss[0].innerHTML = " - Subscribed";
    });
  }

  function unsubscribeApp(page_id, page_access_token) {
    console.log('Subscribing page to app! ' + page_id);
    FB.api(
      '/' + page_id + '/subscribed_apps', 
      'DELETE',
      {access_token: page_access_token},
      function(response) {
      console.log('Successfully unsubscribed page', response);
      var ss = document.getElementsByClassName(page_id);
      ss[0].innerHTML = " - Unsubscribed";
    });
  }

  function subscribeall(page_access_token) {}

	// Only works after `FB.init` is called
	function myFacebookLogin() {
	  FB.login(function(response){
	  	console.log('Successfully Logged in', response);
      FB.api('/me/accounts?limit=500', function ( response ) {
        console.log('Successfully retrieved pages', response);
        var pages = response.data;
        var ul = document.getElementById('list');
        console.log(pages.length);
        for (var i = 0, len = pages.length; i < len; i++) {
          (function() {
          var page = pages[i];
          FB.api(
            '/'+ page.id +'/subscribed_apps',
            'GET',
            {access_token: page.access_token},
            function (response) {
              var li = document.createElement('li');
              var span = document.createElement('span');
              span.innerHTML = page.name + " - ";
              var ds = document.createElement('span');
              ds.innerHTML = " / ";
              var a = document.createElement('a');
              a.href = '#';
              a.onclick = subscribeApp.bind(this, page.id, page.access_token);
              a.innerHTML = "Subscribe";
              var ua = document.createElement('a');
              ua.href = '#';
              ua.onclick = unsubscribeApp.bind(this, page.id, page.access_token);
              ua.innerHTML = "Unsubscribe";
              li.appendChild(span);
              li.appendChild(a);
              li.appendChild(ds);
              li.appendChild(ua);
              ul.appendChild(li);
              var ss = document.createElement('span');
              ss.className = page.id;
              ss.innerHTML = " - Unsubscribed";
              if (response.data.length > 0) {
                ss.innerHTML = " - Subscribed";
              }
              li.appendChild(ss);
          });
          })();
          
          
          // subscribeApp(page.id, page.access_token);
        }
      });
	  }, {scope: 'manage_pages'});
	}
</script>

<button onclick="myFacebookLogin()">Login with Facebook</button>

<ul id="list"></ul>