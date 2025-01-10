// Global variable to store the currently opened video ID
var currentVideoId = '';

function openVideoModal(videoId) {
    var modal = document.getElementById('video-modal'); // Correct ID
    var iframe = modal.querySelector('iframe');
    iframe.src = 'https://www.youtube.com/embed/' + videoId; // Set video URL
    modal.style.display = 'block'; // Show the modal
    currentVideoId = videoId; // Store the current video ID
}

function closeModal() {
    var modal = document.getElementById('video-modal'); // Correct ID
    var iframe = modal.querySelector('iframe');
    iframe.src = ''; // Stop video playback
    modal.style.display = 'none'; // Hide the modal
    currentVideoId = ''; // Clear the current video ID
}

// Optional: If you want to stop video playback when clicking outside the modal
window.onclick = function(event) {
    var modal = document.getElementById('video-modal'); // Correct ID
    if (event.target === modal) {
        closeModal(); // Close the modal and stop the video
    }
}
