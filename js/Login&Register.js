// scripts.js
window.addEventListener('load', function() {
  const loader = document.querySelector('.loader');

  // Set a timeout for 10 seconds (10000 milliseconds)
  setTimeout(function() {
    loader.classList.add('fade-out');
  }, 4500); // 10000 milliseconds = 10 seconds

  // Hide the loader and show the content after the transition ends
  loader.addEventListener('transitionend', function() {
    if (loader.classList.contains('fade-out')) {
      loader.style.display = 'none';
      document.querySelector('.content').style.display = 'block'; // Show main content after loader fades out
    }
  });
});