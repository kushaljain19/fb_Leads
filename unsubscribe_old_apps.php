<h2>My Platform</h2>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1244334662267045',
      xfbml      : true,
      version    : 'v2.6'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
  function unSubscribeApp(page_id, page_access_token) {
    console.log('Unsubscribing app from page! ' + page_id);
    FB.api(
      '/' + page_id + '/subscribed_apps',
      'delete',
      {access_token: page_access_token},
      function(response) {
        console.log('Successfully unsubscribed page', response);
      }
    );
  }
  // Only works after `FB.init` is called
  function myFacebookLogin() {
    FB.login(function(response){
      console.log('Successfully logged in', response);
      FB.api('/me/accounts', function(response) {
        console.log('Successfully retrieved pages', response);
        var pages = response.data;
        var ul = document.getElementById('list');
        for (var i = 0, len = pages.length; i < len; i++) {
          var page = pages[i];
          var li = document.createElement('li');
          var a = document.createElement('a');
          a.href = "#";
          a.onclick = unSubscribeApp.bind(this, page.id, page.access_token);
          a.innerHTML = page.name;
          li.appendChild(a);
          ul.appendChild(li);
        }
      });
    }, {scope: 'manage_pages'});
  }
</script>
<button onclick="myFacebookLogin()">Login with Facebook</button>
<ul id="list"></ul>
