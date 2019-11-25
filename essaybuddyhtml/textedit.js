//document.getElementById('heading').innerHTML = localStorage['title'] || 'Title';
//document.getElementById('content').innerHTML = localStorage['text'] || 'Body';

 setInterval(function() {
      localStorage['title'] = document.getElementById('heading').innerHTML;
      localStorage['text'] = document.getElementById('content').innerHTML;
 }, 1000);